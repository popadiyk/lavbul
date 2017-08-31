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
use App\User;
use App\Jobs\SendMailInvoice;
use App\CashHistory;

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
     *
     * @param Request $request
     * @return bool
     */
    public function makeOrderSaleWithInvoice(Request $request)
    {
        if(Auth::user()) {
            if (Auth::user()->getClient()->first() != null)
                $client_id = $author_id =  Auth::user()->getClient()->first()->id;
            else
                $client_id = $author_id = 1;
        }else {
            $client_id = $author_id = 1;
    //        $user_id = $author_id = User::where('role_id', 2)->first()->id;
        }

        $invoice = $this->createInvoice(Invoice::TYPE_SALES, $client_id, $author_id, Cart::total());

        $order = new Order($request->all());

        $order->user_id = $client_id;
        $order->status_id = OrderStatus::CONFIRMED;

        $order->invoice_id = $invoice->id;
        $order->save();

        /* here is place for dispatch() job for sending email with invoice */
        if($this->saleProducts($order)) {
            Cart::destroy();
           //Sending email with new Invoice to user
            dispatch(new SendMailInvoice($invoice));
            return true;
        }

        // delete invoice and order, because the $this->saleProducts return false
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
        if (Auth::user())
            $invoice->total_account = (float)$total_account * Auth::user()->getDiscount();
        else
            $invoice->total_account = (float)$total_account;

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

    /**
     * Checked qty product for marking
     * @param $marking
     * @param $wantedQty
     * @return bool
     */
    public function isValidQty($goods){
        foreach ($goods as $good){
            $checkedProduct = Product::where('marking', $good['marking'])->first();
            $realQty = $checkedProduct->quantity;
            if ($good['qty'] > $realQty){
                return false;
            }
        }
        return true;
    }

    /**
     * Cheked is RealSumm == invoiceSumm
     * @param $realSumm
     * @param $invoceSumm
     * @return bool
     */
    public function isValidSumm($realSumm, $invoceSumm){
        if ($realSumm != $invoceSumm){
            return false;
        }
        return true;
    }

    /**
     * Calculate RealSum
     * @param $goods
     * @param $discount
     * @return int
     */
    public function getInvoiceSumm($goods, $discount, $type){
        $realSumm = 0;
        if ($type == 'sales'){
            foreach ($goods as $good){
                $currentProduct = Product::where('marking', $good['marking'])->first();
                $realSumm = $realSumm + $currentProduct->price * $good['qty'];
            }
            if (!$discount){
                $discount = 1;
            }
            return $realSumm * $discount;
        } else if ($type == 'purchase' || $type == 'realisation'){
            foreach ($goods as $good){
                $currentProduct = Product::where('marking', $good['marking'])->first();
                $realSumm = $realSumm + $currentProduct->purchase_price * $good['qty'];
            }
            return $realSumm;
        } else if ($type == 'writeOf'){
            return $realSumm;
        }
    }
    
    public function createInvoiceAdmin($request){
        if ($request->type == 'sales'){
            $invoice = new Invoice();
            $invoice->type = $request->type;
            if ($request->cash_type){
                $invoice->cash_type = $request->cash_type;
            } else {
                $invoice->cash_type = 0;
            }
            if ($request->client){
                $invoice->client_id = $request->client;
            } else {
                $invoice->client_id = 1;
            }
            $invoice->author_id = Auth::user()->id;
            $invoice->status = Invoice::STATUS_FAILED;
            $invoice->total_account = $this->getInvoiceSumm($request->goods, $request->discount, $request->type);
            $invoice->save();

            foreach ($request->goods as $good){
                $currentProduct = Product::where('marking', $good['marking'])->first();
                $currentProductMove = new ProductMove();
                $currentProductMove->product_id = $currentProduct->id;
                $currentProductMove->invoice_id = $invoice->id;
                $currentProductMove->quantity = $good['qty'];
                $currentProductMove->sum = $good['qty'] * $currentProduct->price * $request->discount;
                $currentProductMove->save();
            }
            $this->changeInvoiceStatus($invoice->id, Invoice::STATUS_CLOSED, $request->type);
            return 1;
        } else if ($request->type == 'purchase'){
            $invoice = new Invoice();
            $invoice->type = $request->type;
            $invoice->client_id = $request->manufacture;
            if ($request->cash_type){
                $invoice->cash_type = $request->cash_type;
            } else {
                $invoice->cash_type = 0;
            }
            $invoice->author_id = Auth::user()->id;
            $invoice->status = Invoice::STATUS_FAILED;
            $invoice->total_account = $this->getInvoiceSumm($request->goods, $request->discount, $request->type);
            $invoice->save();
            foreach ($request->goods as $good){
                $currentProduct = Product::where('marking', $good['marking'])->first();
                $currentProductMove = new ProductMove();
                $currentProductMove->product_id = $currentProduct->id;
                $currentProductMove->invoice_id = $invoice->id;
                $currentProductMove->quantity = $good['qty'];
                $currentProductMove->sum = $good['qty'] * $currentProduct->purchase_price;
                $currentProductMove->save();
            }
            $this->changeInvoiceStatus($invoice->id, Invoice::STATUS_CLOSED, $request->type);
            return 1;
        } else if ($request->type == 'writeOf'){
            $invoice = new Invoice();
            $invoice->type = $request->type;
            if ($request->cash_type){
                $invoice->cash_type = $request->cash_type;
            } else {
                $invoice->cash_type = 0;
            }
            $invoice->client_id = Auth::user()->id;
            $invoice->author_id = Auth::user()->id;
            $invoice->status = Invoice::STATUS_FAILED;
            $invoice->total_account = 0;
            $invoice->save();
            foreach ($request->goods as $good){
                $currentProduct = Product::where('marking', $good['marking'])->first();
                $currentProductMove = new ProductMove();
                $currentProductMove->product_id = $currentProduct->id;
                $currentProductMove->invoice_id = $invoice->id;
                $currentProductMove->quantity = $good['qty'];
                $currentProductMove->sum = 0;
                $currentProductMove->save();
            }
            $this->changeInvoiceStatus($invoice->id, Invoice::STATUS_CLOSED, $request->type);
            return 1;
        } else if ($request->type == 'realisation') {
            $invoice = new Invoice();
            $invoice->type = $request->type;
            if ($request->cash_type){
                $invoice->cash_type = $request->cash_type;
            } else {
                $invoice->cash_type = 0;
            }
            $invoice->client_id = $request->manufacture;
            $invoice->author_id = Auth::user()->id;
            $invoice->status = Invoice::STATUS_FAILED;
            $invoice->total_account = $this->getInvoiceSumm($request->goods, $request->discount, $request->type);;
            $invoice->save();

            $productMoves = ProductMove::all();
            foreach ($productMoves as $productMove) {
                if ($productMove->getProductType(Invoice::where('id', $invoice->id)->first()->client_id) != null) {
                    $productMove->realisation = $invoice->id;
                    $productMove->isPaid = true;
                    $productMove->save();
                }
            }

            $this->changeInvoiceStatus($invoice->id, Invoice::STATUS_CLOSED, $request->type);
            return 1;
        } else {
            return 0;
        }
        
    }

    public function changeInvoiceStatus($invoice_id, $status, $type){
        $currentInvoice = Invoice::where('id', $invoice_id)->first();
        if ($type == 'sales' || $type == 'writeOf'){

            // для кеш хісторі
//            if ($type == 'sales'){
//                if (($currentInvoice->status == Invoice::STATUS_CLOSED) && ($status == Invoice::STATUS_FAILED || $status == Invoice::STATUS_CONFIRMED)){
//                    $cashHistory = new CashHistory();
//                    if (CashHistory::orderby('created_at', 'desc')->first()){
//                        $previousBalance = CashHistory::orderby('created_at', 'desc')->first()->cash_balance;
//                    } else {
//                        $previousBalance = 0;
//                    }
//                    $cashHistory->sum = $currentInvoice->total_account;
//                    $cashHistory->cash_type = CashHistory::CASH;
//                    $cashHistory->cash_balance = $previousBalance - $cashHistory->sum;
//                    $cashHistory->reason = 'Sales invoice';
//                    $cashHistory->invoice_id = $invoice_id;
//                    $cashHistory->save();
//                }
//                if (($currentInvoice->status == Invoice::STATUS_CONFIRMED || $currentInvoice->status == Invoice::STATUS_FAILED) && ($status == Invoice::STATUS_CLOSED)){
//                    $cashHistory = new CashHistory();
//                    if (CashHistory::orderby('created_at', 'desc')->first()){
//                        $previousBalance = CashHistory::orderby('created_at', 'desc')->first()->cash_balance;
//                    } else {
//                        $previousBalance = 0;
//                    }
//                    $cashHistory->sum = $currentInvoice->total_account;
//                    $cashHistory->cash_type = CashHistory::CASH;
//                    $cashHistory->cash_balance = $previousBalance + $cashHistory->sum;
//                    $cashHistory->reason = 'Sales invoice';
//                    $cashHistory->invoice_id = $invoice_id;
//                    $cashHistory->save();
//                }
//
//            }
            // кінець записів для кеш хісторі

            if (($currentInvoice->status == Invoice::STATUS_CLOSED || $currentInvoice->status == Invoice::STATUS_CONFIRMED) && $status == Invoice::STATUS_FAILED){
                $productMoves = ProductMove::all()->where('invoice_id', $invoice_id);
                foreach ($productMoves as $productMove){
                    $currentProduct = Product::where('id', $productMove->product_id)->first();
                    $currentProduct->quantity = $currentProduct->quantity + $productMove->quantity;
                    $currentProduct->save();
                }
            }

            if (($currentInvoice->status == Invoice::STATUS_FAILED) && ($status == Invoice::STATUS_CLOSED || $status == Invoice::STATUS_CONFIRMED)){
                $productMoves = ProductMove::all()->where('invoice_id', $invoice_id);
                foreach ($productMoves as $productMove){
                    $currentProduct = Product::where('id', $productMove->product_id)->first();
                    $currentProduct->quantity = $currentProduct->quantity - $productMove->quantity;
                    if ($currentProduct->quantity < 0) {
                        return -1;
                    }
                    $currentProduct->save();
                }
            }
        }
        
        if ($type == 'purchase'){

            // для кеш хісторі
//            if ($currentInvoice->client()->manufactureType() == 'fact'){
//                if (($currentInvoice->status == Invoice::STATUS_CLOSED) && ($status == Invoice::STATUS_FAILED || $status == Invoice::STATUS_CONFIRMED)){
//                    $cashHistory = new CashHistory();
//                    if (CashHistory::orderby('created_at', 'desc')->first()){
//                        $previousBalance = CashHistory::orderby('created_at', 'desc')->first()->cash_balance;
//                    } else {
//                        $previousBalance = 0;
//                    }
//                    $cashHistory->sum = $currentInvoice->total_account;
//                    $cashHistory->cash_type = CashHistory::CASH;
//                    $cashHistory->cash_balance = $previousBalance + $cashHistory->sum;
//                    $cashHistory->reason = 'Purchase invoice';
//                    $cashHistory->invoice_id = $invoice_id;
//                    $cashHistory->save();
//                }
//                if (($currentInvoice->status == Invoice::STATUS_CONFIRMED || $currentInvoice->status == Invoice::STATUS_FAILED) && ($status == Invoice::STATUS_CLOSED)){
//                    $cashHistory = new CashHistory();
//                    if (CashHistory::orderby('created_at', 'desc')->first()){
//                        $previousBalance = CashHistory::orderby('created_at', 'desc')->first()->cash_balance;
//                    } else {
//                        $previousBalance = 0;
//                    }
//                    $cashHistory->sum = $currentInvoice->total_account;
//                    $cashHistory->cash_type = CashHistory::CASH;
//                    $cashHistory->cash_balance = $previousBalance - $cashHistory->sum;
//                    $cashHistory->reason = 'Purchase invoice';
//                    $cashHistory->invoice_id = $invoice_id;
//                    $cashHistory->save();
//                }
//
//            }
            // кінець записів для кеш хісторі

            if (($currentInvoice->status == Invoice::STATUS_CLOSED || $currentInvoice->status == Invoice::STATUS_CONFIRMED) && $status == Invoice::STATUS_FAILED){
                $productMoves = ProductMove::all()->where('invoice_id', $invoice_id);
                foreach ($productMoves as $productMove){
                    $currentProduct = Product::where('id', $productMove->product_id)->first();
                    $currentProduct->quantity = $currentProduct->quantity - $productMove->quantity;
                    if ($currentProduct->quantity < 0) {
                        return -1;
                    }
                    $currentProduct->save();
                }
            }

            if (($currentInvoice->status == Invoice::STATUS_FAILED) && ($status == Invoice::STATUS_CLOSED || $status == Invoice::STATUS_CONFIRMED)){
                $productMoves = ProductMove::all()->where('invoice_id', $invoice_id);
                foreach ($productMoves as $productMove){
                    $currentProduct = Product::where('id', $productMove->product_id)->first();
                    $currentProduct->quantity = $currentProduct->quantity + $productMove->quantity;
                    $currentProduct->save();
                }
            }
        }
        
        if ($type = 'realisation'){
            if (($currentInvoice->status == Invoice::STATUS_CLOSED || $currentInvoice->status == Invoice::STATUS_CONFIRMED) && $status == Invoice::STATUS_FAILED) {
                $productMoves = ProductMove::all()->where('realisation', $invoice_id);
                foreach ($productMoves as $productMove) {
                    $productMove->isPaid = false;
                    $productMove->save();
                }
            }

            if (($currentInvoice->status == Invoice::STATUS_FAILED) && ($status == Invoice::STATUS_CLOSED || $status == Invoice::STATUS_CONFIRMED)){
                $productMoves = ProductMove::all()->where('realisation', $invoice_id);
                foreach ($productMoves as $productMove) {
                    $productMove->realisation = $invoice_id;
                    $productMove->isPaid = true;
                    $productMove->save();
                }
            }
        }

        $currentInvoice->status = $status;
        $currentInvoice->save();
    }

    
}