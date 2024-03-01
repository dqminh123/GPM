<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    protected $table='sanpham';
    protected $fillable=['id','tensp','slug','xuatxu_id','nhacungcap_id','danhmuc_id','gianhap','giamgia','giaxuat','soluong','chitiet','anh','list_anh','moi','noibat'];
    public $timestamps=false;
    public function xuatxu(){
        return $this->hasOne(xuatxu::class,'id','xuatxu_id');
      }
    public function danhmuc(){
        return $this->hasOne(danhmuc::class,'id','danhmuc_id');
      }
    public function nhacungcap(){
        return $this->hasOne(nhacungcap::class,'id','nhacungcap_id');
      }

      public function baohanh(){
        return $this->hasOne(baohanh::class,'id','baohanh_id');
      }  

      public function dathang_chitiet(){
        return $this->hasMany(dathang_chitiet::class,'sanpham_id','id');
        }

        public function comments()
    {
        return $this->hasMany(comment::class,'sanpham_id','id')->orderBy('id','DESC');
    }

      public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('tensp','like','%'.$tukhoa.'%');
        }
        return $query;
  
    }
}
