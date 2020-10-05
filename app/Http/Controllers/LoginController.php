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

use App\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where($credentials)->first();

        $sql = User::where('email',$request->email)->where('password',$request->password)->whererole('customer','==',$request->role)->get();
        $rst = $sql->count();

        // echo $request->email."_".$request->password."_".$request->role."_".$user."_".$rst;exit();

        if ($user && $rst!='0') { 
            // reff : https://vegibit.com/how-to-create-user-registration-in-laravel/
            auth()->login($user); // agar bs dipanggil auth()->user()->name

            $request->session()->put('data',$request->input());

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

	        $user_login = auth()->user()->name;
        	$data['status_login'] = $user_login;

	        return view('layouts.content',$data);
        }else{
        	return redirect()->back();
        }
    }

    public function logout()
    {
    	Auth::logout();
    	session()->forget('data');
    	return view('auth.login');
    }
}
