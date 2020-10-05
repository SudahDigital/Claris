<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table ='carts';
    protected $fillable = ['product_id','mount','user_id'];
    //
    public function product()
	{
	    return $this->hasOne('App\Product', 'id');
	}
}
