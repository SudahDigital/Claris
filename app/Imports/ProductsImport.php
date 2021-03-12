<?php

namespace App\Imports;

use App\product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    

    public function model(array $row)
    {   
        $dateNow = date('Y-m-d H:i:s');
        return new product([
            'product_code'=>$row['product_code'],
            'product_name' => $row['product_name'],
            'product_harga' => $row['product_harga'],
            'product_description'=>$row['product_description'],
            'product_stock' => $row['product_stock'],
            'product_discount'=>$row['product_discount'],
            'product_image'=>$row['product_image'],
            'created_at'=>$dateNow
        ]);
    }

    
}
