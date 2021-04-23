<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table ='pay';
    protected $fillable = ['invoice_pay','name_cust','alamat_cust','telepon_cust','email_cust','amount','status'];
}
