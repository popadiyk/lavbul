<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function index()
   {
       $products = Product::all();

       foreach($products as $product) {
           dump($product->group->title);
       }
   }
}
