<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhmuc extends Model
{
    use HasFactory;
    protected $table='danhmuc';
    protected $fillable=['id','tendanhmuc','slug','trangthai','anh'];
    public $timestamps=false;
    public function sanpham(){
        return $this->hasMany(sanpham::class,  'danhmuc_id', 'id');
    }
}
