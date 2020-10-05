<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\ProductImage;

class DashProductController extends Controller
{
    public function index()
    {
        $sql = "select a.*, b.image_link, c.category_name from products as a 
        		left join product_images as b on a.id = b.product_id 
        		left join categorys as c on c.id = a.category_id";
    	$product = DB::select($sql);

        $data['product'] = $product;

        return view ('admin.layouts.dashproduk', $data);   
    }

    public function add()
    {
        return view ('admin.layouts.inputproduk');   
    }

    public function edit(Request $request)
    {
    	$sql = "select a.*, b.image_link from products as a inner join product_images as b on a.id = b.product_id where a.id= '".$request->id."'";
    	$product = DB::select($sql);

    	$sql_c = "select * from categorys";
    	$category = DB::select($sql_c);

    	$data['produk_id'] = $product[0]->id;
    	$data['produk_nama'] = $product[0]->product_name;
    	$data['produk_desc'] = $product[0]->product_description;
    	$data['produk_harga'] = $product[0]->product_harga;
    	$data['produk_kategori'] = $product[0]->category_id;
    	$data['image_nama'] = $product[0]->image_link;
    	$data['kategori'] = $category;

        return view ('admin.layouts.editproduk', $data);   
    }

    public function create(Request $request)
    {
		if(isset($_FILES['upl_image'])){
    		$errors= array();
	      	$file_name = $_FILES['upl_image']['name'];
	      	$file_size = $_FILES['upl_image']['size'];
	      	$file_tmp = $_FILES['upl_image']['tmp_name'];
	      	$file_type = $_FILES['upl_image']['type'];
		      
		    if($file_size > 2097152) {
		        $errors[]='File size must be excately 2 MB';
		    }

		    if(empty($errors)==true){
			    if(move_uploaded_file($file_tmp,"assets/image/product/".$file_name)) {

		  			$product = Product::create([
						'category_id' => $_POST['kat_produk'],
						'product_name' => $_POST['produk_nama'],
						'product_harga' => $_POST['harga_produk'],
						'product_description' => $_POST['ket_produk']
					]);

		  			$sql = "select id from products where product_name = '".$_POST['produk_nama']."' ";
		  			$rst = DB::select($sql);

		  			$product_image = ProductImage::create([
						'image_link' => $file_name,
						'product_id' => $rst[0]->id,
						'is_tumbnail' => ''
					]);
		        }
		    }
	    }

		return redirect('admin/dash-produk')->with(['success' => 'Product Berhasil di Proses']);
    }

    public function update(Request $request)
    {

    	$update = "update products set 
    					product_name = '".$request->produk_nama."', 
    					product_description = '".$request->ket_produk."', 
    					product_harga = '".$request->harga_produk."', 
    					category_id = '".$request->kat_produk."' 
    				where id = '".$request->produk_id."' 
    			";

    	$product = DB::update($update);

    	if(isset($_FILES['upl_image'])){
    		$errors= array();
	      	$file_name = $_FILES['upl_image']['name'];
	      	$file_size = $_FILES['upl_image']['size'];
	      	$file_tmp = $_FILES['upl_image']['tmp_name'];
	      	$file_type = $_FILES['upl_image']['type'];
		      
		    if($file_size > 2097152) {
		        $errors[]='File size must be excately 2 MB';
		    }

		    if(empty($errors)==true){
			    if(move_uploaded_file($file_tmp,"assets/image/product/".$file_name)) {
		  			echo "success";

		  			$update_img = "update product_images set
		    						image_link = '".$file_name."'
		    					where product_id = '".$request->produk_id."'
		    				";
		    		$product_image = DB::update($update_img);
		        }
		    }
	    }

		return redirect('admin/dash-produk')->with(['success' => 'Product Berhasil di Update']);
    }

    public function delete($id)
    {
    	$delete = Product::where('id',$id)->delete();
    	$delete_img = ProductImage::where('product_id',$id)->delete();

		return redirect('admin/dash-produk')->with(['success' => 'Product Berhasil di Hapus']);
    }
}