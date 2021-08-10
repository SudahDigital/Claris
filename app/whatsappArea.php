<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class whatsappArea extends Model
{
    protected $table ='whatsapp_area';
    protected $fillable = ['area_name','area_number','created_at','updated_at'];
}
