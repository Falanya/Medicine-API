<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'type_id', 'describe', 'info', 'price', 'view', 'discount', 'img', 'slug', 'status'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function cart() {
        return $this->belongsTo(Cart::class,'product_id','id');
    }

    public function img_details() {
        return $this->hasMany(ImgProduct::class, 'product_id', 'id')->where('status', 1);
    }
}