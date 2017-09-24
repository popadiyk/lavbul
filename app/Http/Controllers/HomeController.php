<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Group;
use App\MainProducts;
use App\ProductPhoto;
use \Cart as Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\MasterClassUser;
use App\MasterClass;
use App\News;
use App\CashHistory;
use App\User;
use App\Mail\SendInvoiceToUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;



class HomeController extends Controller
{
    const PER_PAGE = 9;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    public function getCashBalance()
    {
        $previousBalanceCash = CashHistory::orderby('created_at', 'desc')->where('cash_type', 'cash')->first()->cash_balance;
        $previousBalanceCard = CashHistory::orderby('created_at', 'desc')->where('cash_type', 'card')->first()->cash_balance;
        $responce = array();
        array_push($responce, $previousBalanceCash);
        array_push($responce, $previousBalanceCard);
        
        return $responce;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = MainProducts::all();
        $products = collect();
        foreach ($items as $key => $value) {
            $products->push(Product::where('marking', $value->marking)->first());
        }
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }
        return view('main.index', ['products' => $products, 'products_id_in_cart' => $products_id_in_cart]);
    }

    public function test(){
        return view('layouts.temp_main');
    }

    public function incrementMarking(Request $request){
        $groupId = $request->all()['groupId'];
        $product = Product::all()->where('group_id', $groupId)->last();
        return $product->marking+1;
    }

    public function products(Request $request){
        $products = Product::all();
        $groups = Group::all();

        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }

        if ($request->group_id) {
            $products = collect();
            $parentGroup = Group::find($request->group_id);

            if($parentGroup->group_id == 0){
                // первое вхождение на выдачу или родительские группы
                $groups = Group::where('group_id', $parentGroup->id)->get();
                foreach ($groups as $key => $group) {
                    $temp_products = Product::where('group_id', $group->id)->get();
                    foreach ($temp_products as $product) {
                        $products->push($product);
                    }
                    $groups = Group::where('group_id', $group->id)->get();
                    foreach ($groups as $key => $group) {
                        $temp_products = Product::where('group_id', $group->id)->get();
                        foreach ($temp_products as $product) {
                            $products->push($product);
                        }
                    }
                }
            } else {
                // дочерние группы
                foreach ($groups as $key => $group) {
                    if($group->id == $request->group_id){
                        $products = Product::where('group_id', $request->group_id)->get();
                        $groups = Group::where('group_id', $request->group_id)->get();
                        foreach ($groups as $key => $group) {
                            $temp_products = Product::where('group_id', $group->id)->get();
                            foreach ($temp_products as $product) {
                                $products->push($product);
                            }
                        }
                    }
                }
            }
        }

        $products_id = [];
        foreach ($products as $element) {
            array_push($products_id, $element->id);
        }

        $products = $this->paginate($products->unique('id'));
        if ($request->ajax()) {
            return response()->json(view('products.products_list', array('products' => $products, 'products_id_in_cart' => $products_id_in_cart, 'products_id' => $products_id, 'groups' => $groups))->render());
        }

        return view('products.index', [ 'products' => $products, 'products_id_in_cart' => $products_id_in_cart, 'products_id' => $products_id, 'groups' => $groups ]);
    }

    public function product($id){
        $product = Product::find($id);
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }
        // $items = MainProducts::all();
        // $products = collect();
        // foreach ($items as $key => $value) {
        //     $products->push(Product::where('marking', $value->marking)->first());
        // }
        $photos = ProductPhoto::where('product_id', $product->id)->get();

        $meta_keywords = preg_split('/\! /', $product->meta_keyword);
        return view('products.product', [ 'product' => $product, 'products_id_in_cart' => $products_id_in_cart, 'photos' => $photos, 'meta_keywords' => $meta_keywords]);
    }

    public function editUser(Request $request, $id){
        $upUser = $request->all();
        $changedUser = User::find($id)->first();
        if ($upUser['password'] == null) {
            unset($upUser['password']);
        } else {
            $upUser['password'] = bcrypt($upUser['password']);
        }
        $changedUser->update($upUser);
        return redirect('/cabinet');
    }

    public function gotomain(Request $request){
        $myProduct = Product::all()->where('id', $request->id)->first();

        // $myProduct->goToMain($request->act);
        // return $request->act;

        return (string)$myProduct->goToMain($request->act);
    }

    public function change_mc_users_status(Request $request){
        $myUser = MasterClassUser::where('id', $request->id)->first();
        $myUser['status'] = $request->status;
        $myUser->save();
    }

    public function paginate($items, $perPage = self::PER_PAGE, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function filterSorting(Request $request)
    {
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }

        if (count($request->products_id) > 0) {
            $products = collect();
            foreach ($request->products_id as $id) {
                $products->push(Product::find($id));
            }
            switch ($request->sort_by) {
                case 'new':
                    $products = $products->sortBy('created_at');
                    break;
                case 'price_up':
                    $products = $products->sortBy('price');
                    break;
                case 'price_down':
                    $products = $products->sortByDesc('price');
                    break;
                case 'name_up':
                    $products = $products->sortBy('title');
                    break;
                case 'name_down':
                    $products = $products->sortByDesc('title');
                    break;
                
                default:
                    $products = $products->sortBy('price');
                    break;
            }
            $products_id = [];
            foreach ($products as $element) {
                array_push($products_id, $element->id);
            }
            $products = $this->paginate($products);
            return response()->json(view('products.products_list', ['products' => $products, 
                                                                'products_id' => $products_id, 
                                                                'products_id_in_cart' => $products_id_in_cart]
                                                                )->render());
        }
    }

    public function pagination(Request $request)
    {
        $products = collect();
        foreach ($request->products_id as $id) {
            $products->push(Product::find($id));
        }
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }
        $products = $this->paginate($products, self::PER_PAGE, $request->page);
        return response()->json(view('products.products_list', ['products' => $products, 
                                                                'products_id' => $request->products_id, 
                                                                'products_id_in_cart' => $products_id_in_cart]
                                                                )->render());
    }

    public function masterclasses(){
        $masterclasses = MasterClass::all();
        return view('master_classes.index', ['masterclasses' => $masterclasses]);
    }

    public function mcreg(Request $request){
        // dd($request);
        $reguser = new MasterClassUser;
        $reguser->mc_id = $request->id;
        $reguser->phone = $request->phone;
        $reguser->name = $request->name;
        $reguser->status = 'new';
        $reguser->save();
        return view('master_classes.afterReg');
    }

    public function sendFeedBack(Request $request){

        Mail::raw('<br>email: '.$request->email.'<br>name: '.$request->name.'<br>msg:'.$request->c_message, function($message)
        {
            $message->from('admin@bulavka.org', 'Лавка-Булавка ! Отзыв ');
            $message->to('apopadiyk@gmail.com')->subject('Отзывы');
        });

        return view('contacts.index')->with('success_message','Дякуємо за відгук! Ми зробимо все, щоб стати найкращим
         магазином у "hand-made" сфері!');
    }

    public function news(){
        $news = News::all();
        return view('news.index', ['news' => $news]);
    }

    public function one_news($id){
        $news = News::find($id);
        return view('news.one_news', ['news' => $news]);
    }

}