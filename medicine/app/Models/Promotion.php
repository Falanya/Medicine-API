<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    protected $fillable = ['code','name','max_users','max_users_user','description','discount_amount','min_amount','type','starts_at','expires_at','status'];
    protected $hidden = ['created_at','updated_at'];
}
