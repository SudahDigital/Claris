<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $table ='banner_images';
    protected $fillable = ['image_banner'];
}