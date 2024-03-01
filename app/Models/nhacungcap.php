<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhacungcap extends Model
{
    use HasFactory;
    protected $table='nhacungcap';
    public $timestamps = false;
    public function sanpham(){
        return $this->hasMany(sanpham::class,  'nhacungcap_id', 'id');
    }
}
