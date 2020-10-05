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
    function index()
    {	
        $user_id = Auth::id();
        if (empty($user_id)) {
            # code...
            $user_id = 0;
        }
        // return $user_id;die;
    	// $data['product'] = Product::with(['product_image'])->paginate(12);

        $prd = DB::table('products')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.image_link')
            ->paginate(12);

        $data['product'] = $prd;
        $data['category'] = Category::all();
        $data['page'] = 'home';

        $cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
            // ->where('product_images.is_tumbnail', 'yes')
            ->get();
        // return $cart;die;
        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;

        $data['status_login'] = '';

    	return view('layouts.content',$data);
    }
    function category(Request $request)
    {
    	$get = $request->all();
    	return $get;
    }
}
