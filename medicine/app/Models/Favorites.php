<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $fillable = ['user_id','product_id'];
    protected $hidden = ['created_at','updated_at'];

    public function product() {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
