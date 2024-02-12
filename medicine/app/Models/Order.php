<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $appends = ['totalPrice'];
    protected $table = 'orders';
    protected $fillable = ['user_id','address_id','note','status', 'token','object_status'];

    public function address() {
        return $this->hasOne(Address::class,'id','address_id');
    }

    public function details() {
        return $this->hasMany(ProductOrder::class,'order_id','id');
    }

    public function getTotalPriceAttribute() {
        $total = 0;
        foreach($this->details as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

}
