<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Cities;
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
        $userAgent  = $request->header('User-Agent'); //session_id();
        $clientIP   = \Request::getClientIp(true);
        $ses_id     = $userAgent.$clientIP;

        $user_id = Auth::id();
        if (empty($user_id)) {
            $user_id = 0;
        }

        $prd = DB::table('products')
            ->select('products.*', 'products.product_image')
            ->get();

        $data['product'] = $prd;
        $data['category'] = Category::all();
        $data['page'] = 'home';

        $cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'products.product_image','products.product_description')
            ->where('carts.session_id', $ses_id)
            ->get();

        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;
        $data['status_login'] = '';

        $banner = DB::Select('SELECT * FROM banner_images');

        $banner_active = "SELECT MIN(id) AS ID_AWAL FROM banner_images";
        $rst_banneract = DB::select($banner_active);

        $data['banner'] = $banner;
        $data['banner_active'] = $rst_banneract[0]->ID_AWAL;

        $data['cities'] = Cities::All();

        $count = Cart::where('user_id', $user_id)->sum('mount');
        
        /*$cart = DB::table('carts')
            ->innerJoin('products', 'products.id', '=', 'carts.product_id')
            ->where('session_id', $ses_id)
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'products.product_image')
            ->get();*/
        $sql = "SELECT carts.*, products.product_name, products.product_harga, products.product_image, (products.product_harga * carts.mount) AS total_harga FROM `carts` INNER JOIN products ON products.id = carts.product_id WHERE carts.session_id = '".$ses_id."'"; 
        $cart_wa = DB::select($sql);

        $data['cart_wa'] = $cart_wa;
        $data['count_cart'] = $count;
        $data['category'] = Category::all();

        return view('layouts.content',$data);
    }
}
