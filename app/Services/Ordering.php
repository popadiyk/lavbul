<?php
/**
 * Created by PhpStorm.
 * User: shesser
 * Date: 02.06.17
 * Time: 0:13
 */

namespace App\Services;

use \Cart as Cart;
use App\Product;
use App\OrderStatus;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Invoice;

use Illuminate\Http\Request;


class Ordering
{

    /**
     * @return array
     */
    public function checkQty()
    {
        $result = array();

        $cart = Cart::content();

       foreach($cart as $item) {

           $product = Product::find($item->id);

           if($product->quantity < $item->qty) {
               session()->flash('error_message', 'An insufficient amount');
               $result[$item->rowId] = $product->quantity;
           }
       }
       return $result;
    }

    /**
     * @param $id
     * @param $quantity
     * @return null
     */
    public function checkQtyOne($id, $quantity)
    {
        $qty = null;

        $item = Cart::get($id);

        $product = Product::find($item->id);

        if($product->quantity < $quantity) {
            $qty = $product->quantity;
        }

        return $qty;
    }

    /**
     * Make the order and generate invoice for sale from online-shop and delivery INSHOP
     * @param Request $request
     */
    public function makeOrderSaleWithInvoice(Request $request)
    {
        $user_id = $author_id =  Auth::id();

        $invoice = $this->createInvoice(Invoice::SALES, $user_id, $author_id, Cart::total());

        $order = new Order($request->all());

        $order->user_id = $user_id;
        $order->status_id = OrderStatus::CONFIRMED;

        $order->invoice_id = $invoice->id;
        $order->save();
    }


    private function createInvoice($type, $client_id, $author_id, $total_account)
    {
        $invoice = new Invoice();
        $invoice->type = $type;
        $invoice->client_id = $client_id;
        $invoice->author_id = $author_id;
        $invoice->total_account = (integer)$total_account;

        $invoice->save();

        return $invoice;
    }
}