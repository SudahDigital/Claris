<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Cart;

class CaraBelanjaController extends Controller
{
    public function index()
    {    	
    	$user_id = Auth::id();
    	if (empty($user_id)) {
    		# code...
    		$user_id = 0;
    	}
    	$count = Cart::where('user_id', $user_id)->count();
        $data['category'] = Category::all();
        $data['count_cart'] = $count;
        return view('layouts.carabelanja', $data);
    }
}
