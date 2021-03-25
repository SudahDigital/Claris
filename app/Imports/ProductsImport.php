<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Illuminate\Support\Facades\DB;

class ProductsImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function sheets(): array
    {
        return [
            'product' => new ProductsImport()
        ];
    }

    public function model(array $data)
    {

    	// print_r($data);exit();
        $dateNow = date('Y-m-d H:i:s');

        $sql = "SELECT * FROM products WHERE product_code = '".$data['product_code']."' ";
        $rst = DB::select($sql);
        $row = count($rst);

        $product_color = strtoupper($data['product_color']);
        $diskon         = $data['product_discount'];
        $harga          = $data['product_price'];
        $price_promo 	= "";
        if($diskon!='' || $diskon != '0'){
	        $potongan       = $harga * ($diskon / 100);
	        $price_promo    = $harga - $potongan;
	    }

        if($row>0){
        	$sql_upt = "UPDATE products SET 
        					product_name = '".$data['product_name']."',
        				    product_harga = '".$data['product_price']."',
        				    product_description = '".$data['product_description']."',
        				    category_id = '".$data['category_id']."',
        				    product_stock  = '".$data['product_stock']."',
        				    product_discount = '".$data['product_discount']."',
        				    product_image = '".$data['product_image']."',
        				    product_color = '".$product_color."',
        				    price_promo = '".$price_promo."',
        				    updated_at = '".$dateNow."'
        				WHERE 
        					product_code = '".$data['product_code']."'";
        	$rst_upt = DB::update($sql_upt);

        }else{

        	$sql_insert = Product::Create([
	            'product_code'=>$data['product_code'],
	            'product_name' => $data['product_name'],
	            'product_harga' => $data['product_price'],
	            'product_description'=>$data['product_description'],
	            'category_id'=>$data['category_id'],
	            'product_stock' => $data['product_stock'],
	            'product_discount'=>$data['product_discount'],
	            'product_image'=>$data['product_image'],
	            'product_color'=>$product_color,
	            'price_promo'=>$price_promo,
	            'created_at'=>$dateNow
	        ]);

        }
    }

    
}
