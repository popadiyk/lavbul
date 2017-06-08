<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Invoice;
use Carbon\Carbon;
use App\Facades\OrderingFacade as MakerOrder;

class TestController extends Controller
{
   public function index()
   {
       $invoices = Invoice::ofType(Invoice::TYPE_SALES)
           ->ofStatus(Invoice::STATUS_CONFIRMED)
           ->isTimeToFailed()
           ->get();

       if(count($invoices) > 0) {
           MakerOrder::returnedProductToBase($invoices);
       }

       MakerOrder::
       dd('flag');
   }
}
