<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailInvoice;
use App\Product;
use App\ProductMove;
use Illuminate\Http\Request;
use App\Invoice;
use Carbon\Carbon;
use App\Facades\OrderingFacade as MakerOrder;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class TestController extends Controller
{
   public function index()
   {

       $invoice = Invoice::find(1);

       $this->dispatch(new SendMailInvoice($invoice));

       dd(Cart::content());
   }
}
