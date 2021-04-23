<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay_d extends Model
{
    protected $table ='pay_d';
    protected $fillable = ['invoice_pay','name_cust','alamat_cust','telepon_cust','email_cust','mount','order_date','product_id','status'];
}
