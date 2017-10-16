<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Group;
use Helper;
use \Cart as Cart;
use App\Http\Controllers\HomeController;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('stop');
        $products = Product::paginate(3);

        return view('tests.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('tests.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function catalogs($id)
    {
        $lastGroups = [];
        $isLast = count(Group::all()->where('group_id', $id));

        $groups = Group::all();
        foreach ($groups as $group){
            if (!count(Group::all()->where('group_id', $group->id)) && $id != $group->id){
                array_push($lastGroups, $group);
            }
            if ($id == $group->id && !$isLast) {
                $catalog = $group;
            }
        }
        // если меньше 5 выводить каталоги которые есть
        if (count($lastGroups) <= 5) {
            return view('catalogs.index', compact('catalog', 'lastGroups'));
        } else {
            // если больше 5 то рандомом 5 каталогов
            $top5catalogs = array_rand($lastGroups, 5);
            $tempArr = [];
            foreach ($top5catalogs as $item){
                array_push($tempArr, $lastGroups[$item]);
            }
            $lastGroups = $tempArr;
        }
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }


        $groupProducts = Product::all()->where('group_id', $id);
        $products = collect();

        $products_id = [];

        foreach ($groupProducts as $groupProduct) {
            $products->push(Product::find($groupProduct->id));
            array_push($products_id, $groupProduct->id);
        }
        $products = HomeController::paginate($products);
        //dd($products);

        return view('catalogs.index', compact('catalog', 'lastGroups', 'products', 'products_id_in_cart', 'products_id'));
    }

}
