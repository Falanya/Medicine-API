<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = ['user_id', 'address', 'phone', 'receiver_name','object_status'];
    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function user() {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
