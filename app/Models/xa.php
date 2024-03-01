<?php

namespace App\Models;

use App\Models\huyen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xa extends Model
{
    use HasFactory;
    protected $table='xa';
    public $timestamps =false;
    protected $fillable= ['id','tenxa','huyen_id'];
    protected $primaryKey ='id';
    
    public function huyen(){
        return $this->hasOne(huyen::class,'id','huyen_id');
    }
    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('tenxa','like','%'.$tukhoa.'%');
        }
        return $query;
  
      }
}