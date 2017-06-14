<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use \Cart as Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test(){
        return view('layouts.temp_main');
    }

    public function products(){
        $products = Product::paginate(9);

        $products_id_in_cart = array();

        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }


        return view('products.index', [ 'products' => $products, 'products_id_in_cart' => $products_id_in_cart ]);
    }

    public function product($id){
        $product = Product::find($id);
        return view('products.product', [ 'product' => $product ]);
    }

}
