<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhanvien extends Model
{
    use HasFactory;
    protected $table='nhanvien';
    protected $fillable=['id','hovaten','dienthoai','diachi','cmnd','ngayinh','chucvu_id','email','tendangnhap','password'];
    public $timestamps=false;

    public function chucvu()
    {
        return $this->hasOne(chucvu::class,'id','chucvu_id');
    }
}
