<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Category;
use App\Cart;



class WelcomeController extends Controller
{
    //
    function index(Request $request)
    {	
        session_start();

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

        $banner = DB::Select('SELECT * FROM banner_images');

        $banner_active = "SELECT MIN(id) AS ID_AWAL FROM banner_images";
        $rst_banneract = DB::select($banner_active);

        $data['banner'] = $banner;
        $data['banner_active'] = $rst_banneract[0]->ID_AWAL;

        $data['status_login'] = '';

    	return view('layouts.content',$data);
    }
    function category(Request $request)
    {
    	$get = $request->all();
    	return $get;
    }
}
