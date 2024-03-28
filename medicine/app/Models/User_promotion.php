<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_promotion extends Model
{
    use HasFactory;
    protected $table = 'user_promotions';
    protected $fillable = ['user_id','promotion_id'];
}
