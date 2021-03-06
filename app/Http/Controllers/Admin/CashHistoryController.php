<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\CashHistory;

class CashHistoryController extends Controller
{
    use BreadRelationshipParser;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
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
        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);
        $view = 'admin.cashhistory.browse';

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));

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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * POST BR(E)AD
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Add a new item of our Data Type BRE(A)D
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $newCashHistory = new CashHistory();
        $newCashHistory->sum = $request->sum;
        $newCashHistory->cash_type = $request->cash_type;
        $newCashHistory->invoice_id = '0';
        if (CashHistory::orderby('created_at', 'desc')->where('cash_type', $request->cash_type)->first()){
            $previousBalance = CashHistory::orderby('created_at', 'desc')->where('cash_type', $request->cash_type)->first()->cash_balance;
        } else {
            $previousBalance = 0;
        }

        if ($request->pm == '+'){
            $newCashHistory->cash_balance = $previousBalance + $newCashHistory->sum;
            $newCashHistory->reason = '(+) '.$request->reason;
        } else {
            $newCashHistory->cash_balance = $previousBalance - $newCashHistory->sum;
            $newCashHistory->reason = '(-) '.$request->reason;
        }
        $newCashHistory->save();
        return redirect()
            ->route('voyager.cashhistory.index')
            ->with([
                'message'    => "Зміни успішно збережені!",
                'alert-type' => 'success',
            ]);
    }
    // POST BRE(A)D
    public function store(Request $request)
    {
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
