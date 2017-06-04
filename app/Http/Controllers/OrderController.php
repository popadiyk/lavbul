<?php

namespace App\Http\Controllers;

use App\Order;
use App;
use Illuminate\Http\Request;
use \Cart as Cart;
use App\Delivery;
use App\PaymentType;
use App\Facades\OrderingFacade as MakerOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @TODO To need checking all items of cart on quantity
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deliveries = Delivery::all();
        $payments = PaymentType::all();

        return view('tests.order', [
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
      if(!Auth::check()) {
          return back()->with('error_message', 'You need checking in the shop');
      }

       $order = new Order($request->all());


       $order->user_id = Auth::id();
       $order->status_id = 1;
       $order->save();
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
