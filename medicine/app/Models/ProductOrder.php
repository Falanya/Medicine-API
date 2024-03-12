<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $table = 'product_orders';
    protected $fillable = ['order_id', 'product_id', 'promotion_id', 'quantity', 'price'];

    public function product() {
        return $this->hasOne(Product::class,'id','product_id');
    }

}
