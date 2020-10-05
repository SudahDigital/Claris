<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use app\Contact;

class DashContactController extends Controller
{
    public function index()
    {
    	$sql = "select * from contacts;";
        $data['contact'] = DB::select($sql);

        return view ('admin.layouts.dashkontak', $data);   
    }

    public function edit(Request $request)
    {
    	$sql = "select * from contacts";
    	$kontak = DB::select($sql);

    	$data['email'] = $kontak[0]->email;
    	$data['no_telp'] = $kontak[0]->no_telp;

        return view ('admin.layouts.editkontak', $data);   
    }

    public function update(Request $request)
    {
    	$update = "update contacts set 
    					email = '".$request->email."',
    					no_telp = '".$request->no_telp."'
    			";

    	$product = DB::update($update);

		return redirect('admin/dash-kontak')->with(['success' => 'Kontak Berhasil di Proses']);
    }
}
