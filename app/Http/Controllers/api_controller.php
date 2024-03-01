<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sanpham;

class api_controller extends Controller
{
    //
    public function sp_search()
    {
        $sp=sanpham::search()->get();
        $result=[
            'status'=>true,
            'message'=>'Tìm được'.$sp->count().'kết quả',
            'sp'=>$sp,
        ];
        return $sp;
    }
}
