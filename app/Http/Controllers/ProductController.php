<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Cart;

class ProductController extends Controller
{
    //
    public function category(Request $request)
    {
    	$input = $request->all();
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
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
            // ->where('product_images.is_tumbnail', 'yes')
            ->get();

        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;
        
        // return $input;die;
    	return view('layouts.content',$data);
    }

    public function search(Request $request)
    {
    	$input = $request->all();
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
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
            // ->where('product_images.is_tumbnail', 'yes')
            ->get();

        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;
    	return view('layouts.content',$data);
    }
    public function detail(Request $request)
    {
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
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
            // ->where('product_images.is_tumbnail', 'yes')
            ->get();

        $data['count_cart'] = count($cart);

        $data['cart'] = $cart;
    	return view('layouts.detail',$data);
    }
}
