<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\thanhpho;
use App\Models\xa;
use App\Models\huyen;
class phivanchuyen extends Model
{
    use HasFactory;
    protected $table = 'phivanchuyen';
    public $timestamps = false;
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'thanhpho_id',
        'huyen_id',
        'xa_id',
        'phi'
    ];
    public function thanhpho(){
        return $this->hasOne(thanhpho::class, 'mathanhpho', 'thanhpho_id');
    }
    public function huyen(){
        return $this->hasOne(huyen::class, 'mahuyen', 'huyen_id');
    }
    public function xa(){
        return $this->hasOne(xa::class, 'maxa', 'xa_id');
    }
}
