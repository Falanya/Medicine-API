<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";
    protected $fillable = ['fullname', 'email', 'password', 'gender'];
    protected $hidden = ['password', 'created_at', 'updated_at', 'created_by', 'updated_by','email_verified_at'];

    public function carts() {
        return $this->hasMany(Cart::class,'user_id','id');
    }

    public function roles() {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    public function addresses() {
        return $this->hasMany(Address::class,'user_id','id');
    }
}
