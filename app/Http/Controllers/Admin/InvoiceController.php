<?php

namespace App\Http\Controllers\Admin;

use App\Invoice;
use App\Product;
use App\Manufacture;
use App\Client;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\ProductMove;
use HelperForImage;
use App\Facades\OrderingFacade as MakerOrder;


class InvoiceController extends Controller
{
    use BreadRelationshipParser;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $manufactures = Manufacture::all();
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission

        Voyager::canOrFail('browse_'.$dataType->name);
        $getter = $dataType->server_side ? 'paginate' : 'get';
        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $relationships = $this->getRelationships($dataType);
            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([
                    $model->with($relationships)->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }
            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }
        //dd($dataTypeContent);
        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);
        $view = 'voyager::bread.browse';
        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }
        
        return view('admin.invoices.browse', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'manufactures'));

    }

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);
        $products = [];

        $invoice = Invoice::where('id', $id)->first();
        if ($invoice->type == 'realisation'){
            $moveProducts = ProductMove::all()->where('realisation', $id);
            $sum = 0;
            //dd($moveProducts);
            foreach ($moveProducts as $moveProduct){
                $sum = $sum + Product::where('id', $moveProduct->product_id)->first()->purchase_price * $moveProduct->quantity;
            }
            if ($sum != $invoice->total_account) {
                return redirect()
                    ->route('voyager.invoices.index')
                    ->with([
                        'message' => "Нажаль ця накладна більше не актуальна!",
                        'alert-type' => 'error',
                    ]);
            }
                foreach ($moveProducts as $moveProduct){
                    $myProduct = Product::where('id', $moveProduct->product_id)->first();
                    $productInArray = [
                        $myProduct->marking,
                        $myProduct->title,
                        $moveProduct->quantity,
                        $myProduct->purchase_price,
                        $myProduct->purchase_price * $moveProduct->quantity
                    ];
                    array_push($products, $productInArray);
                }
        } else {
            $moveProducts = ProductMove::all()->where('invoice_id', $id);
            foreach ($moveProducts as $moveProduct){
                $myProduct = Product::where('id', $moveProduct->product_id)->first();
                $productInArray = [
                    $myProduct->marking,
                    $myProduct->title,
                    $moveProduct->quantity,
                    $moveProduct->sum/$moveProduct->quantity,
                    $moveProduct->sum
                ];
                array_push($products, $productInArray);
            }
        }



        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission

        Voyager::canOrFail('browse_'.$dataType->name);
        $getter = $dataType->server_side ? 'paginate' : 'get';
        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $relationships = $this->getRelationships($dataType);
            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([
                    $model->with($relationships)->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }
            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }
        //dd($dataTypeContent);
        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);
        $view = 'voyager::bread.browse';
        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view('admin.invoices.edit', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'invoice', 'products'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $errMsg = [];
        // Первіряємо чи є така кількість товарів яка прийшла з інвойса
        if ($request->type == 'sales' || $request->type == 'writeOf'){
            $tf = MakerOrder::isValidQty($request->goods);
            if ($tf == false){
                array_push($errMsg, 'Бажана кількість товарів не доступна, перевірте залишки!');
            }
        }
        // Підрахуємо реальну вартість по накладній
        $realSumm = MakerOrder::getInvoiceSumm($request->goods, $request->discount, $request->type);
        // Перевіряємо валідність сумми
        $isSummValid = MakerOrder::isValidSumm($realSumm, $request->invoiceSumm);
        if ($isSummValid == false){
            array_push($errMsg, 'Загальна сумма товарів не співпадає з обрахованою на сервері! Перевірте ціни!');
        }
        // якщо накладна пройшла валідність
        if (empty($errMsg)){
            return MakerOrder::createInvoiceAdmin($request);
            //return ;
        }
        else {
            return $errMsg;
        }
//        return redirect()
//            ->route('voyager.invoices.index');
    }

    /**
     * POST BR(E)AD
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $result = MakerOrder::changeInvoiceStatus($invoice->id, $request->status, $invoice->type);
        if ($result == -1){
            return redirect()
                ->route('voyager.invoices.index')
                ->with([
                'message'    => "Ви не можете змінити статус накладної, деякий товар вже проданий!",
                'alert-type' => 'error',
            ]);
        }

        return redirect()
            ->route('voyager.invoices.index')
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ]);
    }

    /**
     * Add a new item of our Data Type BRE(A)D
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Який інвойс будемо створювати
        $newInvoice = new Invoice();
        $manufacture = $request->manufacture;
        $newInvoice->type = $request->type;
        $clients = Client::all();

        //dd($manufacture);
        //dd($request->search);

        if($newInvoice->type == "sales" || $newInvoice->type == "writeOf") {
            if ($request->search != null) {
                $search = $request->search;
                $products = [];
                $columns = ['marking', 'title'];
                if ($search) {
                    foreach ($columns as $column) {
                        $items = Product::where($column, 'like', '%' . $search . '%')->get();
                        if (count($items) > 0) {
                            foreach ($items as $item) {
                                if(!in_array($item, $products)){
                                    array_push($products, $item);
                                }
                            }
                        }
                    }
                    $products = HelperForImage::paginate($products, 10);
                    $products->withPath('create?type='.$newInvoice->type.'&search='.$request->search);
                    //dd($products);
                }
            } else {
                $products = Product::paginate(10);
                $products->withPath('create?type='.$newInvoice->type);
            }
        }

        if ($newInvoice->type == "purchase"){
            //dd($manufacture);
            if ($request->search != null) {
                $search = $request->search;
                $products = [];
                $columns = ['marking', 'title'];
                if ($search) {
                    foreach ($columns as $column) {
                        $items = Product::where($column, 'like', '%' . $search . '%')->where('manufacture_id', $manufacture)->get();
                        if (count($items) > 0) {
                            foreach ($items as $item) {
                                if(!in_array($item, $products)){
                                    array_push($products, $item);
                                }
                            }
                        }
                    }
                    $products = HelperForImage::paginate($products, 10);
                    $products->withPath('create?type='.$newInvoice->type.'&manufacture='.$manufacture.'&search='.$request->search);
                    //dd($products);
                }
            } else {
                $products = Product::where('manufacture_id', $manufacture)->paginate(10);
                $products->withPath('create?type='.$newInvoice->type.'&manufacture='.$manufacture);
            }

        }
        $productRealizations = [];
        $invoceRealizations = [];
        if ($newInvoice->type == "realisation"){
            $productMoves = ProductMove::all();
            $tf = false;
            foreach ($productMoves as $oneProductMove){

                if ($oneProductMove->getProductType($manufacture) != null) {
                    for ($i = 0; $i < count($productRealizations); $i++) {
                        if ($productRealizations[$i][0] == $oneProductMove->getProductType($manufacture)[0]) {
                            $productRealizations[$i][2] += $oneProductMove->getProductType($manufacture)[2];
                            $productRealizations[$i][4] += $oneProductMove->getProductType($manufacture)[4];
                            $tf = true;
                            break;
                        } else $tf = false;
                    }
                    if ($tf == false)
                    array_push($productRealizations, $oneProductMove->getProductType($manufacture));
                    array_push($invoceRealizations, $oneProductMove->getInvoices());
                }
            }
            //dd($invoceRealizations);
        }

//        if ($request->search != null){
//            return view('admin.invoices.data-edit-add', compact('products'));
//        }


        if ($request->ajax()){
            //dd($request->ajax());
//            dd($newInvoice->manufacture);
//            dd($products);
            return view('admin.invoices.data-edit-add', compact('products'));
        }

        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('add_'.$dataType->name);
        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;
        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);
        return view('admin.invoices.edit-add', compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'newInvoice', 'products', 'manufacture', 'productRealizations', 'invoceRealizations', 'clients'));
    }

    /**
     * Delete an item BREA(D)
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
    }

}
