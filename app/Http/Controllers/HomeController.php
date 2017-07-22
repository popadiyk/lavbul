<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Group;
use App\MainProducts;
use App\ProductPhoto;
use \Cart as Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\MasterClassUser;


class HomeController extends Controller
{
    const PER_PAGE = 9;

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

    public function products(Request $request){
        $products = Product::all();
        $groups = Group::all();
        
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }

        if ($request->group_id) {
            $products = collect();
            $parentGroup = Group::find($request->group_id);
            if($parentGroup->group_id == 0){
                $groups = Group::where('group_id', $parentGroup->id)->get();
                foreach ($groups as $key => $group) {
                    $temp_products = Product::where('group_id', $group->id)->get();
                    foreach ($temp_products as $product) {
                        $products->push($product);
                    }
                }
            } else{
                foreach ($groups as $key => $group) {
                    if($group->id == $request->group_id){
                        $products = Product::where('group_id', $request->group_id)->get();
                    }
                }
            }
        }

        $products_id = [];
        foreach ($products as $element) {
            array_push($products_id, $element->id);
        }

        $products = $this->paginate($products->unique('id'));
        if ($request->ajax()) {
            return response()->json(view('products.products_list', array('products' => $products, 'products_id_in_cart' => $products_id_in_cart, 'products_id' => $products_id, 'groups' => $groups))->render());
        }

        return view('products.index', [ 'products' => $products, 'products_id_in_cart' => $products_id_in_cart, 'products_id' => $products_id, 'groups' => $groups ]);
    }

    public function product($id){
        $product = Product::find($id);
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }
        // $items = MainProducts::all();
        // $products = collect();
        // foreach ($items as $key => $value) {
        //     $products->push(Product::where('marking', $value->marking)->first());
        // }
        $photos = ProductPhoto::where('product_id', $product->id)->get();

        return view('products.product', [ 'product' => $product, 'products_id_in_cart' => $products_id_in_cart, 'photos' => $photos ]);
    }

    public function gotomain(Request $request){
        $myProduct = Product::all()->where('id', $request->id)->first();

        // $myProduct->goToMain($request->act);
        // return $request->act;

        return (string)$myProduct->goToMain($request->act);
    }

    public function change_mc_users_status(Request $request){
        $myUser = MasterClassUser::where('id', $request->id)->first();
        $myUser['status'] = $request->status;
        $myUser->save();
    }

    public function paginate($items, $perPage = self::PER_PAGE, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function filterSorting(Request $request)
    {
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }

        if (count($request->products_id) > 0) {
            $products = collect();
            foreach ($request->products_id as $id) {
                $products->push(Product::find($id));
            }
            switch ($request->sort_by) {
                case 'new':
                    $products = $products->sortBy('created_at');
                    break;
                case 'price_up':
                    $products = $products->sortBy('price');
                    break;
                case 'price_down':
                    $products = $products->sortByDesc('price');
                    break;
                case 'name_up':
                    $products = $products->sortBy('title');
                    break;
                case 'name_down':
                    $products = $products->sortByDesc('title');
                    break;
                
                default:
                    $products = $products->sortBy('price');
                    break;
            }
            $products_id = [];
            foreach ($products as $element) {
                array_push($products_id, $element->id);
            }
            $products = $this->paginate($products);
            return response()->json(view('products.products_list', ['products' => $products, 
                                                                'products_id' => $products_id, 
                                                                'products_id_in_cart' => $products_id_in_cart]
                                                                )->render());
        }
    }

    public function pagination(Request $request)
    {
        $products = collect();
        foreach ($request->products_id as $id) {
            $products->push(Product::find($id));
        }
        $products_id_in_cart = array();
        foreach(Cart::content() as $item) {
            array_push($products_id_in_cart, $item->id);
        }
        $products = $this->paginate($products, self::PER_PAGE, $request->page);
        return response()->json(view('products.products_list', ['products' => $products, 
                                                                'products_id' => $request->products_id, 
                                                                'products_id_in_cart' => $products_id_in_cart]
                                                                )->render());
    }

    public function masterclasses(){
        return view('master_classes.index');
    }


}