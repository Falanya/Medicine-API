<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';
    protected $fillable = ['name'];
    protected $primaryKey = 'code';
    public $incrementing = false;

    public function districts() {
        return $this->belongsTo(District::class,'district_code','code');
    }
}