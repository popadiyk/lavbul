<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use \Cart as Cart;
use Validator;
use App\Facades\OrderingFacade as MakerOrder;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tests.cart');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->products);
        if ($request->products != null){
            foreach ($request->products as $product)
            Cart::update($product[0], $product[1]);
        return 1;
        }

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });
        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }
        Cart::add($request->id, $request->name, 1, $request->price, ['marking' => $request->marking])
            ->associate('App\Product');
       /* return response()->json(['success' => true]);*/
        return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    }

    /**
     * For ajax
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_js(Request $request)
    {
        $item = $request->all();
        Cart::add($item['id'], $item['name'], $item['quantity'], $item['price'], ['marking' => $item['marking']])
            ->associate('App\Product');
        if (Auth::user()){
            if(Auth::user()->getClient())
                if (Auth::user()->getClient()->first() != null) {
                    $discount = (100 - Auth::user()->getClient()->first()->discount) / 100;
                } else {
                    $discount = 1;
                }
            else
                $discount = 1;
        } else {
            $discount = 1;
        }
        return response()->json(['success'=> true, 'total' => Cart::total() , 'discount' => $discount]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCart()
    {
        return view('cart.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // Validation on max quantity
        dd($request);
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,100'
        ]);
        if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 5.');
            return response()->json(['success' => false]);
        }
        $checkQty = MakerOrder::checkQtyOne($request->id, $request->quantity);
        if($checkQty !== null) {
            session()->flash('error_message', 'Quantity was too much! Prefer is '.$checkQty );
            return response()->json([
                'success' => false,
                'item'=> Cart::get($id),
                'allowable_qty' => $checkQty
            ]);
        }
        Cart::update($request->id, $request->quantity);

        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true, 'item'=> Cart::get($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->withSuccessMessage('Товар успішно видалений із замовлення!');
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
    }

    /**
     * Get total quantity for ajax in modal cart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTotalQty()
    {
        $total_qty = Cart::count();
        $amount_total = Cart::total();
        $total_products = count(Cart::content());
        return response()->json([
            'total_qty'=> $total_qty,
            'total_products' => $total_products,
            'summ_total' => $amount_total,
        ]);
    }

    /**
     * For ajax
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProductFromCart($id)
    {
        Cart::remove($id);

        return response()->json(['success'=> true, 'rawId' => $id]);
    }
}