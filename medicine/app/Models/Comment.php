<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['user_id','product_id','comment'];

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
