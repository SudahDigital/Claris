<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function product_image()
	{
	    return $this->hasOne(ProductImage::class);
	}

	protected $table ='products';
    protected $fillable = ['category_id','product_name','product_harga','product_description'];
}
