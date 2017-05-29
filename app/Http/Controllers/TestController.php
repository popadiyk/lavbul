<?php

namespace App\Http\Controllers;
use App\Manufacture;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function index()
   {
       $mun = Manufacture::find(1);

       dd($mun->typeId);
   }
}
