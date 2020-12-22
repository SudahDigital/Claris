<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\ProductImage;
use App\Category;

class DashProductController extends Controller
{
    public function index()
    {
        $sql = "SELECT 
                    a.*, 
                    b.category_name 
                from products as a 
        		left join categorys as b on b.id = a.category_id
            ";

    	$product = DB::select($sql);
        $data['product'] = $product;

        return view ('admin.product.list_product', $data);   
    }

    public function add()
    {
        $data['category'] = Category::all();
        return view ('admin.product.create_product', $data);   
    }

    public function view(Request $request)
    {
        $sql = "SELECT 
                    a.* ,
                    b.category_name
                FROM products a 
                INNER JOIN categorys b ON b.id = a.category_id
                WHERE 
                    a.id = '".$request->id."'";

        $rst    = DB::select($sql);
        $data   = $rst;
        $data['formatharga'] = "Rp. ".number_format($rst[0]->product_harga).",-";

        if($rst[0]->flag_top == 'Y'){
            $data['flag_top'] = '<span class="badge bg-primary" style="color: #fff;">YES</span>';
        }else{
            $data['flag_top'] = '<span class="badge bg-danger" style="color: #fff;">NO</span>';
        }

        return ($data);
    }

    public function edit(Request $request)
    {
    	$sql = "SELECT 
                    a.* ,
                    b.category_name
                FROM products a 
                INNER JOIN categorys b ON b.id = a.category_id
                WHERE 
                    a.id = '".$request->id."'
            ";
    	$product = DB::select($sql);

    	$sql_c = "select * from categorys";
    	$category = DB::select($sql_c);

    	$data['produk_id'] = $product[0]->id;
    	$data['produk_nama'] = $product[0]->product_name;
    	$data['produk_desc'] = $product[0]->product_description;
    	$data['produk_harga'] = $product[0]->product_harga;
    	$data['produk_kategori'] = $product[0]->category_id;
        $data['produk_stock'] = $product[0]->product_stock;
        $data['produk_discount'] = $product[0]->product_discount;
    	$data['image_nama'] = $product[0]->product_image;
    	$data['kategori'] = $category;

        return view ('admin.product.edit_product', $data);   
    }

    public function create(Request $request)
    {
        // print_r($_POST);exit();
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

                    if (empty($_POST['top_produk'])){ 
                        $top_produk = ''; 
                    }else{
                        $top_produk = $_POST['top_produk'];
                    }

                    $product = DB::insert("
                                INSERT INTO products (
                                    category_id,
                                    product_name,
                                    product_harga,
                                    product_description,
                                    product_stock,
                                    product_discount,
                                    flag_top,
                                    product_image,
                                    created_at
                                ) VALUES (
                                    '".$_POST['kat_produk']."',
                                    '".$_POST['produk_nama']."',
                                    '".$_POST['harga_produk']."',
                                    '".$_POST['ket_produk']."',
                                    '".$_POST['stock_produk']."',
                                    '".$_POST['diskon_produk']."',
                                    '".$top_produk."',
                                    '".$file_name."',
                                    now()
                                );
                            ");
                    if($product){
                        return redirect('admin/dash-produk')->with(['hasil' => 'Success']);
                    }
		        }
		    }
	    }

		return redirect('admin/dash-produk')->with(['hasil' => 'Failed']);
    }

    public function update(Request $request)
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

            $product_image ="";
            if($file_name) { $product_image = "product_image = '".$file_name."'," ;}

		    if(empty($errors)==true){
                $update = "UPDATE products SET 
                        product_name = '".$request->produk_nama."', 
                        product_description = '".$request->ket_produk."', 
                        product_harga = '".$request->harga_produk."',
                        product_stock = '".$request->stock_produk."',
                        product_discount = '".$request->diskon_produk."', 
                        flag_top = '".$request->top_produk."',
                        $product_image
                        category_id = '".$request->kat_produk."'
                    WHERE id = '".$request->produk_id."' 
                ";
                $product = DB::update($update);

			    if($product) {
                    move_uploaded_file($file_tmp,"assets/image/product/".$file_name);
		        }
		    }
	    }

		return redirect('admin/dash-produk')->with(['success' => 'Product Berhasil di Update']);
    }

    public function delete($id)
    {
    	$delete = Product::where('id',$id)->delete();
        if($delete){
		  return redirect('admin/dash-produk')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-produk')->with(['hasil' => 'failed']);
    }
}