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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Invoice;
use Illuminate\Http\Request;
use App\ProductMove;

/**
 * Class Ordering
 * @package App\Services
 *
 * @method Request public makeOrderSaleWithInvoice(Request $request)
 */
class Ordering
{
    /**
     * Checking quantity of all products in the cart before beginning order
     * @return array
     */
    public function checkQty()
    {
        $result = array();

        $cart = Cart::content();

       foreach($cart as $item) {

           $product = Product::find($item->id);

           if(! $product->isEnoughQty($item->qty)) {
               session()->flash('error_message', 'An insufficient amount');
               $result[$item->rowId] = $product->quantity;
           }
       }
       return $result;
    }

    /**
     * Checking quantity of a product
     * @param $id
     * @param $quantity
     * @return null
     */
    public function checkQtyOne($id, $quantity)
    {
        $qty = null;

        $item = Cart::get($id);

        $product = Product::find($item->id);

        if(!$product->isEnoughQty($quantity)) {
            $qty = $product->quantity;
        }

        return $qty;
    }

    /**
     * Make the order and generate invoice for sale from online-shop and delivery INSHOP
     * @param Request $request
     * @return bool
     */
    public function makeOrderSaleWithInvoice(Request $request)
    {
        $user_id = $author_id =  Auth::id();

        $invoice = $this->createInvoice(Invoice::TYPE_SALES, $user_id, $author_id, Cart::total());

        $order = new Order($request->all());

        $order->user_id = $user_id;
        $order->status_id = OrderStatus::CONFIRMED;

        $order->invoice_id = $invoice->id;
        $order->save();

        if($this->saleProducts($order)) {
            Cart::destroy();
            return true;
        }

        // delete invoice and order, becouse the $this->saleProducts return false
        $order->delete();
        $invoice->delete();

        return false;
    }


    public function returnedProductToBase($invoices)
    {
        /** @var Invoice $invoice */
        foreach($invoices as $invoice ) {
            //change status Invoice to failed
            $invoice->changeStatus(Invoice::STATUS_FAILED);

            /** @var Order $order */
            $order = $invoice->order;
            if( $order != null ) {
                $order->changeStatus(OrderStatus::FAILED);
            }

            /** @var Collection ProductMove $productsMove */
            $productsMove = $invoice->productMove;

            $this->increaseProductsQty($productsMove);
        }
    }

    /**
     * Increase quantity of the products which belong to invoice
     * (and are involve by product_move table) and raw of them in product_moves are deleted
     *
     * @param Collection ProductMove $productsMove
     */
    private function increaseProductsQty($productsMove)
    {

        /** @var ProductMove $productMove */
        foreach($productsMove as $productMove)  {
            $productMove->product->increaseQty($productMove->quantity);

            $productMove->delete();
        }
    }

    /**
     * @TODO $invoice->total_account needs integer, now it isn't correct
     * @param $type
     * @param $client_id
     * @param $author_id
     * @param $total_account
     * @return Invoice
     */
    private function createInvoice($type, $client_id, $author_id, $total_account)
    {
        $invoice = new Invoice();
        $invoice->type = $type;
        $invoice->client_id = $client_id;
        $invoice->author_id = $author_id;
        $invoice->status = Invoice::STATUS_CONFIRMED;
        $invoice->total_account = (integer)$total_account;

        $invoice->save();

        return $invoice;
    }

    /**
     * The client generated invoice, the products in the order are reserved
     * @TODO Create method for returned products when client didn't pay invoice during 1 day
     * @TODO Create exceptions when $product->decreaseQty returns false in the last loop
     * @param $order
     * @return bool
     */
    private function saleProducts($order)
    {
        $order_decoder = json_decode($order->cart);

        // to check on quantity of products
        foreach($order_decoder as $item) {
            $product = Product::find($item->id);
            if(!$product->isEnoughQty($item->qty)) {
                return false;
            }
        }

        // to move products which is in the order
        foreach($order_decoder as $item) {
            $productMove = new ProductMove();

            /** @var Product $product */
            $product = Product::find($item->id);

           if(! $productMove->addProduct($product, $order->invoice_id, $item->qty) ) {
               return false;
           }
        }
        return true;
    }
}