<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Category;
use App\Cart;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ses_id =  $request->header('User-Agent'); //session_id();

        $user_id = Auth::id();
        if (empty($user_id)) {
            $user_id = 0;
        }

        $prd = DB::table('products')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.image_link')
            ->get();

        $data['product'] = $prd;
        $data['category'] = Category::all();
        $data['page'] = 'home';

        $cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
            ->where('carts.session_id', $ses_id)
            ->get();

        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;
        $data['status_login'] = '';

        return view('layouts.content',$data);
    }
}
