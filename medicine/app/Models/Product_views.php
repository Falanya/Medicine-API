<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_views extends Model
{
    use HasFactory;
    protected $table = 'product_views';
    protected $fillable = ['user_id','product_id'];
    protected $hidden = ['created_at','updated_at'];
}
