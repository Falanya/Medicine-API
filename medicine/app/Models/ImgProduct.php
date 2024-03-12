<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    use HasFactory;
    protected $table = 'img_products';
    protected $fillable = ['img','product_id','status'];
    protected $hidden = ['created_at','updated_at'];
}
