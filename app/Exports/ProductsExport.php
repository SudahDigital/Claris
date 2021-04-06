<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function map($product) : array {
        return[
                $product->id,
                $product->product_name,
                $product->product_description,
                $product->product_harga,
                $product->product_stock,
            ];
    }

    public function headings() : array {
        return [
           'Product_id',
           'Product_Name',
           'Description',
           'Price',
           'Stock',
        ] ;
    }
}
