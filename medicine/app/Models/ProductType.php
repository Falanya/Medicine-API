<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_types';
    protected $fillable = ['name', 'object_status'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function products() {
        return $this->hasMany(Product::class, 'type_id', 'id')->where('status',1);

    }
}
