<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductMove;
use Illuminate\Http\Request;
use App\Invoice;
use Carbon\Carbon;
use App\Facades\OrderingFacade as MakerOrder;

class TestController extends Controller
{
   public function index()
   {
      $product = ProductMove::find(1);

      dd(number_format($product->sum, 2));
   }
}
