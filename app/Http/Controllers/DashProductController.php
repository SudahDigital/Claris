<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;

use App\Product;
use App\ProductImage;
use App\Category;

class DashProductController extends Controller
{
    public function index(Request $request)
    {
        $where = ($request->status == 'draft') ? "WHERE a.flag_draft = 'Y'" : "WHERE a.flag_draft is NULL OR a.flag_draft = 'N'" ;

        $sql = "SELECT 
                a.*, 
                b.category_name 
            FROM products as a 
            LEFT JOIN categorys as b on b.id = a.category_id
            $where

        ";
        $product = DB::select($sql);
        $data['product'] = $product;
        $data['status']  = $request->status;

        return view ('admin.product.list_product', $data);   
    }

    public function execute($par)
    {
        $where = ($par == 'draft') ? "WHERE a.flag_draft = 'Y'" : '' ;
        $sql_draft = "SELECT 
                    a.*, 
                    b.category_name 
                FROM products as a 
                LEFT JOIN categorys as b on b.id = a.category_id
                $where
            ";

        // echo $sql_draft; exit();

        $product_draft = DB::select($sql_draft);
        $data['product'] = $product_draft;

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
                LEFT JOIN categorys b ON b.id = a.category_id
                WHERE 
                    a.id = '".$request->id."'
            ";

    	$product = DB::select($sql);

    	$sql_c = "select * from categorys";
    	$category = DB::select($sql_c);

    	$data['produk_id'] = $product[0]->id;
        $data['produk_kode'] = $product[0]->product_code;
    	$data['produk_nama'] = $product[0]->product_name;
    	$data['produk_desc'] = $product[0]->product_description;
    	$data['produk_harga'] = $product[0]->product_harga;
    	$data['produk_kategori'] = $product[0]->category_id;
        $data['produk_stock'] = $product[0]->product_stock;
        $data['diskon_produk'] = $product[0]->product_discount;
    	$data['image_nama'] = $product[0]->product_image;
        $data['warna_produk'] = $product[0]->product_color;
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
                        $top_produk = 'N'; 
                    }else{
                        $top_produk = $_POST['top_produk'];
                    }

                    //--price promo--//
                        $price_promo = "NULL";
                        if($_POST['diskon_produk'] > 0){
                            $diskon         = $_POST['diskon_produk'];
                            $harga          = $_POST['harga_produk'];
                            $potongan       = $harga * ($diskon / 100);
                            $price_promo    = "'".$harga - $potongan."'";
                        }
                    //--price promo--//

                    $product = DB::insert("
                                INSERT INTO products (
                                    category_id,
                                    product_code,
                                    product_name,
                                    product_harga,
                                    product_description,
                                    product_stock,
                                    product_discount,
                                    product_color,
                                    flag_top,
                                    product_image,
                                    price_promo,
                                    created_at
                                ) VALUES (
                                    '".$_POST['kat_produk']."',
                                    '".$_POST['produk_kode']."',
                                    '".$_POST['produk_nama']."',
                                    '".$_POST['harga_produk']."',
                                    '".$_POST['ket_produk']."',
                                    '".$_POST['stock_produk']."',
                                    '".$_POST['diskon_produk']."',
                                    '".$_POST['warna_produk']."',
                                    '".$top_produk."',
                                    '".$file_name."',
                                    ".$price_promo.",
                                    now()
                                );
                            ");
                    if($product){
                        return redirect('admin/dash-produk')->with(['hasil' => 'Success']);
                    }
		        }
		    }
	    }else{
            if (empty($_POST['top_produk'])){ 
                $top_produk = 'N'; 
            }else{
                $top_produk = $_POST['top_produk'];
            }

            //--price promo--//
                $price_promo = "NULL";
                if($_POST['diskon_produk'] > 0){
                    $diskon         = $_POST['diskon_produk'];
                    $harga          = $_POST['harga_produk'];
                    $potongan       = $harga * ($diskon / 100);
                    $price_promo    = "'".$harga - $potongan."'";
                }
            //--price promo--//

            $product = DB::insert("
                        INSERT INTO products (
                            category_id,
                            product_code,
                            product_name,
                            product_harga,
                            product_description,
                            product_stock,
                            product_discount,
                            product_color,
                            flag_top,
                            product_image,
                            price_promo,
                            created_at
                        ) VALUES (
                            '".$_POST['kat_produk']."',
                            '".$_POST['produk_kode']."',
                            '".$_POST['produk_nama']."',
                            '".$_POST['harga_produk']."',
                            '".$_POST['ket_produk']."',
                            '".$_POST['stock_produk']."',
                            '".$_POST['diskon_produk']."',
                            '".$_POST['warna_produk']."',
                            '".$top_produk."',
                            '".$file_name."',
                            ".$price_promo.",
                            now()
                        );
                    ");
            if($product){
                return redirect('admin/dash-produk')->with(['hasil' => 'Success']);
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

		    // if(empty($errors)==true){

                if (empty($request->top_produk)){ 
                    $top_produk = 'N'; 
                }else{
                    $top_produk = $request->top_produk;
                }

                //--price promo--//
                $price_promo = "NULL";
                if($request->diskon_produk > 0){
                    $diskon         = $request->diskon_produk;
                    $harga          = $request->harga_produk;
                    $potongan       = $harga * ($diskon / 100);
                    $price_promo    = "'".($harga - $potongan)."'";
                }
                //--price promo--//

                $update = "UPDATE products SET 
                        product_code = '".$request->produk_kode."', 
                        product_name = '".$request->produk_nama."', 
                        product_description = '".$request->ket_produk."', 
                        product_harga = '".$request->harga_produk."',
                        product_stock = '".$request->stock_produk."',
                        product_discount = '".$request->diskon_produk."', 
                        product_color = '".$request->warna_produk."',
                        flag_top = '".$top_produk."',
                        price_promo = ".$price_promo.",
                        $product_image
                        category_id = '".$request->kat_produk."'
                    WHERE id = '".$request->produk_id."' 
                ";

                // echo $update; exit();
                $product = DB::update($update);

			    if($product) {
                    move_uploaded_file($file_tmp,"assets/image/product/".$file_name);
		        }
		    // }
	    }

		return redirect('admin/dash-produk')->with(['success' => 'Product Berhasil di Update']);
    }

    public function delete(Request $request)
    {
        if($request->par == ''){
            $delete = DB::update("UPDATE products SET flag_draft = 'Y' WHERE id = '".$request->id."'");
        }else{
            $delete = Product::where('id',$request->id)->delete();
        }

        if($delete){
		  return redirect('admin/dash-produk')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-produk')->with(['hasil' => 'failed']);
    }

    public function import_view(Request $request){
        return view ('admin.product.import_product'); 
    }

    public function import_data(Request $request)
    {
        // \Validator::make($request->all(), [
        //     "file" => "required|mimes:xls,xlsx"
        // ])->validate();
        
        // $data = Excel::toArray(new ProductsImport, request()->file('file')); 

        // $update = collect(head($data))
        //     ->each(function ($row, $key){
        //         DB::table('products')
        //             ->where('id', $row['product_code'])
        //             ->update(Arr::except($row,['product_code']));   
        //     });
        
        // if($update){
        //     return redirect()->route('import_produk')->with('status', 'File successfully upload'); 
        // }

        // print_r($_FILES['upl_file']);exit();

        $file_name = $_FILES['upl_file']['name'];
        $file_size = $_FILES['upl_file']['size'];
        $file_tmp = $_FILES['upl_file']['tmp_name'];
        $file_type = $_FILES['upl_file']['type'];

        Excel::import(new ProductsImport, $file_tmp);

        return redirect()->route('import_produk')->with('status', 'File successfully upload'); 
    }

    public function download_tpl(Request $request){
        $path       = public_path('tpl/product.xlsx');
        $name       = 'product.xlsx';
        $headers    = ['Content-Type: application/vnd.ms-excel'];

        return response()->download($path, $name, $headers);
    }

    public function export_all() {
        return Excel::download( new ProductsExport(), 'Products.xlsx');
    }
}