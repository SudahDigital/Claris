<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Category;

class DashCategoryController extends Controller
{
    public function index()
    {
        $data['category'] = Category::all();

        return view ('admin.layouts.dashkategori', $data);   
    }

    public function add()
    {
        return view ('admin.layouts.inputkategori');   
    }

    public function edit(Request $request)
    {
    	$sql = "select * from categorys where id = ".$request->id."";
    	$kategori = DB::select($sql);

    	$data['kategori_id'] = $kategori[0]->id;
    	$data['kategori_nama'] = $kategori[0]->category_name;

        return view ('admin.layouts.editkategori', $data);   
    }

    public function create(Request $request)
    {
    	$product = Category::create([
			'category_name' => $request->kategori_nama
		]);

		return redirect('admin/dash-kategori')->with(['success' => 'Product Berhasil di Proses']);
    }

    public function update(Request $request)
    {
    	$update = "update categorys set 
    					category_name = '".$request->kategori_nama."'
    				where id = '".$request->kategori_id."' 
    			";

    	$product = DB::update($update);

		return redirect('admin/dash-kategori')->with(['success' => 'Product Berhasil di Proses']);
    }

    public function delete($id)
    {
    	$delete = Category::where('id',$id)->delete();

		return redirect('admin/dash-kategori')->with(['success' => 'Product Berhasil di Proses']);
    }
}
