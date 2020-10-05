<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DashHomeController extends Controller
{
    public function index() {
    	$sql = DB::select('select * from users');
    	$count = count($sql);
    	$data['total_konsumen'] = $count;

    	$sql_pay = DB::select('select * from pay');
    	$count = count($sql_pay);
    	$data['total_penjualan'] = $count;

        return view('admin/dashboard', $data); 
    }
}
