<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $table ='customer_order';
    protected $fillable = ['name','no_telp','address','city','ip_address','user_agent'];
}
