<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $append = ['totalPriceCart','statusVerify'];
    protected $table = "users";
    protected $fillable = ['fullname', 'email', 'password', 'gender','phone','birthday', 'role_id','status','email_verified_at'];
    protected $hidden = ['password', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    public function carts() {
        return $this->hasMany(Cart::class,'user_id','id')->where('status', 1);
    }

    public function roles() {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    public function addresses() {
        return $this->hasMany(Address::class,'user_id','id')->where('object_status', 1);
    }

    public function orders() {
        return $this->hasMany(Order::class,'user_id','id')->orderBy('id','DESC');
    }

    public function comment() {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function favorites() {
        return $this->hasMany(Favorites::class,'user_id','id')->orderBy('id','DESC');
    }

    public function getTotalPriceCartAttribute() {
        $total = 0;
        foreach($this->carts as $item) {
            $price = $item->product->discount > 0 && $item->product->discount < $item->product->price ? $item->product->discount : $item->product->price;
            $total += $price * $item->quantity;
        }
        return number_format($total);
    }

    public function getStatusVerifyAttribute() {
        $past = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $message = '';
        if($this->email_verified_at == null) {
            $message = 'User not verified ';
        } else {
            $message = 'User verified ';
        }
        return  $message . '(Created ' . $past->diffForHumans($now) . ')';
    }

}
