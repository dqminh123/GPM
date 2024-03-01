<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dathang_chitiet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='dathang_chitiet';
    protected $fillable=['dathang_id','sanpham_id','soluong','phivanchuyen','dongia'];
    public function sanpham(){
        return $this->hasOne(sanpham::class,'id','sanpham_id');
    }
    
    public function dathang(){
        return $this->hasOne(dathang::class,'id','dathang_id');
    }
}
