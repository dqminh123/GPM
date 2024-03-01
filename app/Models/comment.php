<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = ['khachhang_id','sanpham_id','content','reply_id'];
    public $timestamps = false;

    public function khachhang()
    {
        return $this->hasOne(khachhang::class,'id','khachhang_id');
    }

    public function replies()
    {
        return $this->hasMany(comment::class,'reply_id','id');
    }
}
