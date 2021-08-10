<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Cities;
use App\Product;
use App\Category;
use App\Cart;

class ProductController extends Controller
{
    //
    public function category(Request $request)
    {
    	$input = $request->all();
        $userAgent  = $request->header('User-Agent'); //session_id();
        $clientIP   = \Request::getClientIp(true);
        $ses_id     = $userAgent.$clientIP;
    	/*$data['product'] = Product::with(['product_image'])->where('category_id',$request->id)->paginate(12);*/
        $prod = DB::table('products')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'products.id')
            ->select('products.*','product_images.image_link')->where('products.category_id',$request->id)->paginate(12);

        $data['product'] = $prod;
        $data['category'] = Category::all();
        // return $input;die;        
        $user_id = Auth::id();
        if (empty($user_id)) {
            # code...
            $user_id = 0;
        }
        $data['category_name'] = $input['category_name'];
        $data['page'] = 'category';
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

        $sql_cust_order = "SELECT * FROM customer_order WHERE ip_address = '".$clientIP."'"; // AND user_agent = '".$userAgent."'
        $cust_order     = DB::select($sql_cust_order);

        $data['cust_order_name']    = $data['cust_order_email'] = $data['cust_order_telp']    = $data['cust_order_address'] = $data['cust_order_city']    = "";
        if($cust_order){
            $data['cust_order_name']    = $cust_order[0]->name;
            $data['cust_order_email']   = $cust_order[0]->email;
            $data['cust_order_telp']    = $cust_order[0]->no_telp;
            $data['cust_order_address'] = $cust_order[0]->address;
            $data['cust_order_city']    = $cust_order[0]->city;
        }
        
        // return $input;die;
    	return view('layouts.content',$data);
    }

    public function search(Request $request)
    {
    	$input = $request->all();
        $userAgent  = $request->header('User-Agent'); //session_id();
        $clientIP   = \Request::getClientIp(true);
        $ses_id     = $userAgent.$clientIP;
        $user_id = Auth::id();
        if (empty($user_id)) {
            # code...
            $user_id = 0;
        }
    	$data['product'] = Product::with(['product_image'])->where('product_name','like','%'.$request->keyword.'%')->paginate(12);
        $data['category'] = Category::all();
        $data['page'] = 'search';
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

        $sql_cust_order = "SELECT * FROM customer_order WHERE ip_address = '".$clientIP."'"; //AND user_agent = '".$userAgent."'
        $cust_order     = DB::select($sql_cust_order);

        $data['cust_order_name']    = $data['cust_order_email'] = $data['cust_order_telp']    = $data['cust_order_address'] = $data['cust_order_city']    = "";
        if($cust_order){
            $data['cust_order_name']    = $cust_order[0]->name;
            $data['cust_order_email']   = $cust_order[0]->email;
            $data['cust_order_telp']    = $cust_order[0]->no_telp;
            $data['cust_order_address'] = $cust_order[0]->address;
            $data['cust_order_city']    = $cust_order[0]->city;
        }

    	return view('layouts.content',$data);
    }
    public function detail(Request $request)
    {
        $ses_id = $request->header('User-Agent'); //session_id();
        $user_id = Auth::id();
        if (empty($user_id)) {
            # code...
            $user_id = 0;
        }
    	$input = $request->all();
    	// $data['product'] = Product::with(['product_image'])->where('id',$request->id)->first();

        $prod = DB::table('products')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'products.id')
            ->select('products.*','product_images.image_link')->where('products.id',$request->id)->first();
        $data['product'] = $prod;
        $data['category'] = Category::all();
        $cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
            ->where('session_id', $ses_id)
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
            // ->where('product_images.is_tumbnail', 'yes')
            ->get();

        $data['count_cart'] = count($cart);

        $data['cart'] = $cart;
        $data['status_login'] = '';
    	return view('layouts.detail',$data);
    }
}
