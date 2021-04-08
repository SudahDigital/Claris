<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table ='carts';
    protected $fillable = ['product_id','mount','color','user_id','session_id','qty_color'];
    //
    public function product()
	{
	    return $this->hasOne('App\Product', 'id');
	}
}
