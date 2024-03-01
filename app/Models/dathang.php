<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dathang extends Model
{
    use HasFactory;
    protected $table='dathang';
    public $timestamps = false;
    protected $fillable=['id','khachhang_id','nhanvien_id','ngaydathang','tinhtrang','tongtien'];

    public function khachhang(){
        return $this->hasOne(khachhang::class,'id','khachhang_id');
    }

    public function nhanvien(){
        return $this->hasOne(nhanvien::class,'id','nhanvien_id');
    }

    public function tinhtrang(){
        return $this->hasOne(tinhtrang::class,'id','tinhtrang_id');
    }
    
    public function dathang_chitiet(){
        return $this->hasMany(dathang_chitiet::class,'dathang_id','id');
    }
}
