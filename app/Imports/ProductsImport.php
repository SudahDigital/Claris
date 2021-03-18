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

class ProductsImport implements ToModel, WithHeadingRow
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
    	// echo $data['product_code'];exit();
    	foreach ($data as $key => $row) {  
	        $dateNow = date('Y-m-d H:i:s');

	        //echo $data['product_code'];

	        // if($row[0] != 'Product Code' && $row[1] != 'Product Name' && $row[2] != 'Product Price' && $row[3] != 'Product Description' && $row[4] != 'Category ID' && $row[5] != 'Product Stock' && $row[6] != 'Product Discount' && $row[7] != 'Product Image'){
		        Product::updateOrCreate([
		            'product_code'=>$data['product_code'],
		            'product_name' => $data['product_name'],
		            'product_harga' => $data['product_price'],
		            'product_description'=>$data['product_description'],
		            'category_id'=>$data['category_id'],
		            'product_stock' => $data['product_stock'],
		            'product_discount'=>$data['product_discount'],
		            'product_image'=>$data['product_image'],
		            'created_at'=>$dateNow
		        ]);
		    // }
	    } //exit();
    }

    
}
