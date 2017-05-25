<?php

namespace App\Http\Controllers;

use App\ManufactureType;
use Illuminate\Http\Request;
use App\Manufacture;


class TestController extends Controller
{
    public function index()
    {
        $manufacture = Manufacture::find(1);
       $type = ManufactureType::find(1);
        dd($type->manufactures);
    }
}
