<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\huyen;
class thanhpho extends Model
{
    use HasFactory;
    protected $table='thanhpho';
    public $timestamps =false;
    protected $fillable= ['id','tenthanhpho'];
    protected $primaryKey ='id';

    public function huyen(){
      return $this->hasMany(huyen::class, 'id', 'thanhpho_id');
  }
    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('tenthanhpho','like','%'.$tukhoa.'%');
        }
        return $query;
  
      }
}