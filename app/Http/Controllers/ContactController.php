<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Cart;

use DB;

class ContactController extends Controller
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

        $sql = DB::select('select * from contacts');

        $data['email'] = $sql[0]->email;
        $data['telp'] = $sql[0]->no_telp;

        return view('layouts.contact', $data);
    }
}
