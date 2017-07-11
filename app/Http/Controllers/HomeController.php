<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Group;
use App\MainProducts;
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
    public function products(){
        $products = Product::paginate(9);
        $groups = Group::all();
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }
        return view('products.index', [ 'products' => $products, 'products_id_in_cart' => $products_id_in_cart, 'groups' => $groups ]);
    }
    public function product($id){
        $product = Product::find($id);
        return view('products.product', [ 'product' => $product ]);
    }
    public function gotomain(Request $request){
        $myProduct = Product::all()->where('id', $request->id)->first();
        $myProduct->goToMain($request->act);

        return $request->act;
    }
}