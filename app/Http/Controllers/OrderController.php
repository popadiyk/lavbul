<?php

namespace App\Http\Controllers;

use App\Order;
use App;
use Illuminate\Http\Request;
use \Cart as Cart;
use App\Delivery;
use App\OrderStatus;
use App\PaymentType;
use App\Facades\OrderingFacade as MakerOrder;
use Illuminate\Support\Facades\Auth;
use App\Invoice;

/**
 * Class OrderController
 * @package App\Http\Controllers
 *
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $client = App\Client::all()->where('user_id', $user_id)->first();
        if ($client){
            $invoices = Invoice::orderBy('id', 'DESK')->get()->where('client_id', $client->id)->where('status', 'closed')->where('type', 'sales');
        } else {
            $invoices = null;
        }
        $success_message = null;
        return view('cabinet.index', compact('invoices', 'success_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // якщо корзина пуста (при натисканні оформити замовлення) редірект на продукти
        if (Cart::content()->count() == 0) {
           return redirect('/products');
        }

        $deliveries = Delivery::all();
        $payments = PaymentType::all();

        return view('order.index', [
            'deliveries' => $deliveries,
            'payments' => $payments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // защита от повторной отправки формы при перезагрузке странице
        if(!$request->session()->has('check')){
           $request->session()->put('check',$request->_check);
            $request->session()->save();
            $check = true;
        } else {
            if($request->_check != $request->session()->get('check')){
         $request->session()->put('check',$request->_check);
                $request->session()->save();
                $check = true;
            } else {
                $check = false;
            }
        }

        if(!$check){
            return back()->with('success_message', 'Дякуємо за замовлення! На Вашу почту відправлений рахунок для оплату!');
        }
       /* if(!Auth::check()) {
          return back()->with('error_message', 'You need to be authoriseted  in the shop');
        }*/
            if (!empty($request)) {
 //               dd($request->all());
                if ($request->cart == '[]')
                    return back()->with('error_message', '  Ваша корзина - пуста :( Спробуйте ще раз! Або зателефонуйте нам! Ми Вдячні Вам за те, що допомагаєте нам створити найкращій "hand-made" магазин в Україні!');
                if(! MakerOrder::makeOrderSaleWithInvoice($request)) {
                    return back()->with('error_message', '  Щось пішло не так :( Спробуйте ще раз! Або зателефонуйте нам! Ми Вдячні Вам за те, що допомагаєте нам створити найкращій "hand-made" магазин в Україні!');
                }
            }


        

        if(Auth::check()) {
            $user_id = Auth::id();
            $client = App\Client::all()->where('user_id', $user_id)->first();
            if ($client){
                $invoices = Invoice::orderBy('id', 'DESK')->get()->where('client_id', $client->id)->where('status', 'closed')->where('type', 'sales');
            } else {
                $invoices = null;
            }
            $success_message = 'Дякуємо за замовлення! На Вашу почту відправлений рахунок для оплату!';
            return view('cabinet.index', compact('invoices', 'success_message'));
        }

        return back()->with('success_message', 'Дякуємо за замовлення! На Вашу почту відправлений рахунок для оплату!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * for testing
     * @TODO delete
     * @param Request $request
     */
    public function execute(Request $request)
    {

        MakerOrder::test();

       $cart = (Cart::content());

        foreach($cart as $item) {
            dump($item->id);
        }
        dd('end');
    }
}
