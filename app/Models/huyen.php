<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\thanhpho;
use App\Models\xa;
class huyen extends Model
{
    use HasFactory;
    protected $table='huyen';
    public $timestamps =false;
    protected $fillable= ['id','tenhuyen','thanhpho_id'];
    protected $primaryKey ='id';
    public function thanhpho(){
        return $this->hasOne(thanhpho::class, 'id', 'thanhpho_id');
    }
    public function xa(){
      return $this->hasMany(xa::class, 'id', 'huyen_id');
  }
    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('tenhuyen','like','%'.$tukhoa.'%');
        }
        return $query;
  
      }
}