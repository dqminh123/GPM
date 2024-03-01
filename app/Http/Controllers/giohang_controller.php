<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\giohang;
use App\Models\sanpham;
use App\Models\thanhpho;
use App\Models\huyen;
use App\Models\xa;
use App\Models\phivanchuyen;
use Session;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class giohang_controller extends Controller
{
    
    
    public function view(){
       $thanhpho = thanhpho::all();
       $phivanchuyen = phivanchuyen::all();
       $huyen = huyen::all();
       $xa = xa::all();
        return view('giohang',compact('thanhpho','huyen','xa','phivanchuyen'));
     }
     public function chonvanchuyenhome(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "thanhpho") {
                $chon_huyen = huyen::where('mathanhpho', $data['mathanhpho'])->orderby('mahuyen', 'ASC')->get();
                $output .= '<option>-- Chọn Huyện --</option>';
                foreach ($chon_huyen as $item) {
                    $output .= '<option value="' . $item->mahuyen . '">' . $item->tenhuyen . '</option>';
                }
            } else {
                $chon_xa = xa::where('mahuyen', $data['mathanhpho'])->orderby('maxa', 'ASC')->get();
                $output .= '<option>-- Chọn Xã --</option>';
                foreach ($chon_xa as $item) {
                    $output .= '<option value="' . $item->maxa . '">' . $item->tenxa . '</option>';
                }
            }
        }
        echo $output;
    }
    //
    public function xoachiphi( Request $request){
        session()->forget('phi');
        return redirect()->back();
    }
    //
    public function tinhvanchuyen(Request $request){
        $data = $request->all();
        if($data['mathanhpho']){
            $vanchuyen = phivanchuyen::where('thanhpho_id',$data['mathanhpho'])->where('huyen_id',$data['mahuyen'])->where('xa_id',$data['maxa'])->get();
            if($vanchuyen){
                $count_vanchuyen = $vanchuyen->count();
                if($count_vanchuyen>0){
                    foreach($vanchuyen as $item){
                        Session::put('phi',$item->phi);
                        Session::save();
                    }
                }else
                {
                    Session::put('phi',20000);
                    Session::save();
                }
            }
          
        }
    }
    //
    public function themvaogio(giohang $giohang, $slug){
        $sanpham=sanpham::where('slug',$slug)->first();
        $giohang->them($sanpham);
        return redirect()->back();
        
    }

    public function xoa(giohang $giohang, $id){
       
        $giohang->xoa($id);
        return redirect()->back();

    }

    public function capnhattang(giohang $giohang, $id){
       
        $giohang->capnhattang($id);
        return redirect()->back();
        
     }

     public function capnhatgiam(giohang $giohang, $id){
        $giohang->capnhatgiam($id);
        return redirect()->back();
        
       
     }

    public function xoahet(giohang $giohang){
        
        $giohang->xoatatca();
        session()->forget('phi');
        return redirect('/giohang');

    }
    

}
