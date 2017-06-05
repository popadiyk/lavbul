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


}