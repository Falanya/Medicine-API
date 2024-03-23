<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $appends = ['totalPrice','discountPrice'];
    protected $table = 'orders';
    protected $fillable = ['tracking_number','user_id','address_id','note', 'promotion_code','status', 'token'];

    public function address() {
        return $this->hasOne(Address::class,'id','address_id');
    }

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function details() {
        return $this->hasMany(ProductOrder::class,'order_id','id');
    }

    public function getTotalPriceAttribute() {
        $total = 0;
        $discount = 0;
        foreach($this->details as $item) {
            $total += $item->price * $item->quantity;
        }

        if(!empty($this->promotion_code)) {
            $promotion = Promotion::where('code', $this->promotion_code)->first();
            if($promotion) {
                if($promotion->type == "percent") {
                    $discount = ($promotion->discount_amount / 100) * $total;
                } elseif ($promotion->type == "fixed") {
                    $discount = $promotion->discount_amount;
                } else {
                    $discount = 0;
                }
            }
        }

        $totalPrice = $total - $discount;

        return $totalPrice;
    }

    public function getDiscountPriceAttribute() {
        $total = 0;
        $discount = 0;
        foreach($this->details as $item) {
            $total += $item->price*$item->quantity;
        }
        if(!empty($this->promotion_code)) {
            $promotion = Promotion::where('code', $this->promotion_code)->first();
            if($promotion) {
                if ($promotion->type == "percent") {
                    $discount = ($promotion->discount_amount / 100) * $total;
                } elseif ($promotion->type == "fixed") {
                    $discount = $promotion->discount_amount;
                } else {
                    $discount = 0;
                }
            }
        }
        return $discount;
    }

}
