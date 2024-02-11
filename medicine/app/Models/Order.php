<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['address_id','note','status','object_status'];

    public function address() {
        return $this->belongsTo(Address::class,'id','address_id');
    }
}
