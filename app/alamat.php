<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alamat extends Model
{
    //
	protected $table ='alamats';
    protected $fillable = ['user_id','name','adress','phone','email'];
}
