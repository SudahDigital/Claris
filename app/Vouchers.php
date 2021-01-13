<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    protected $table ='vouchers';
    protected $fillable = ['code','name','description','uses','max_uses','type','discount_amount','starts_at','expires_at','status'];
}
