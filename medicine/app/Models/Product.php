<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'type_id', 'describe', 'info', 'quantity', 'view', 'price', 'discount', 'img', 'slug', 'status'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function productTypes(){
        return $this->belongsTo(ProductType::class, 'type_id','id');
    }
    public function cart() {
        return $this->belongsTo(Cart::class,'product_id','id');
    }

    public function img_details() {
        return $this->hasMany(ImgProduct::class, 'product_id', 'id')->orderBy('sort_order','ASC')->where('status', 1);
    }

    public function comments() {
        return $this->hasMany(Comment::class,'product_id','id');
    }
}
