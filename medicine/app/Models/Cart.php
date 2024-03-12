<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['user_id','product_id','quantity'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product() {
        return $this->hasOne(Product::class,'id','product_id');
    }

}
