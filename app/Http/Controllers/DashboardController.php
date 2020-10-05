<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Auth;
use DB;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view ('admin.login_dashboard'); 
    }

    public function checklogin(Request $request)
    {

	    $credentials = $request->only('name', 'password');

        $user = User::where($credentials)->first();

        if ($user) { 
            // reff : https://vegibit.com/how-to-create-user-registration-in-laravel/
            auth()->login($user); // agar bs dipanggil auth()->user()->name

            $request->session()->put('data',$request->input());

	    	$sql_user = DB::select('select * from users');
	    	$count = count($sql_user);
	    	$data['total_konsumen'] = $count;

	    	$sql_pay = DB::select('select * from pay');
	    	$count = count($sql_pay);
	    	$data['total_penjualan'] = $count;
	    	$data['status']="Selamat Datang";
	        return view('admin/dashboard', $data);
        }else{
        	return redirect()->back();
        }
    }

    /*public function checklogin(Request $request)
    {

	    dd(Auth::attempt(['name'=>$request->email, 'password'=>$request->password]));

        if (Auth::attempt(['name' => $request->email, 'password' => $request->password])) {
            echo "SUCCESS";

            $request->session()->put('data',$request->input());

	    	$sql_user = DB::select('select * from users');
	    	$count = count($sql_user);
	    	$data['total_konsumen'] = $count;

	    	$sql_pay = DB::select('select * from pay');
	    	$count = count($sql_pay);
	    	$data['total_penjualan'] = $count;

	    	return view('admin/dashboard', $data);
        }else{
        	echo "FAILED";
        	// return redirect('/admin');
        }
    }*/

    public function logout()
    {
    	Auth::logout();
    	session()->forget('data');
    	return view('admin.login_dashboard');
    }
}
