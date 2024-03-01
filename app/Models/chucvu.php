<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    use HasFactory;
    protected $table = 'chucvu';
    protected $fillable = ['tenchucvu','quyen'];
    public $timestamps = false;

    public function nhanvien(){
        return $this->hasMany(nhanvien::class,'nhanvien_id','id');
    }
}
