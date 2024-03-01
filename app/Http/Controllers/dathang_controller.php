<?php

namespace App\Http\Controllers;

use App\Models\dathang;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\sanpham;
use App\Models\dathang_chitiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\mail;
use Carbon\Carbon;
use Session;
use App\Helper\giohang;
use App\Mail\dathang_email;
use App\Models\khachhang;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class dathang_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('kh_middleware');
       
    }
    public function index()
    {
        return view('dathang');
    }
    public function add(Request $request , giohang $giohang)
    {
       
        $data = $request->all();
       
        $id=Auth::guard('khachhang')->user()->id;
        $dathang=new dathang;
        $dathang->khachhang_id=$id;
        $dathang->tinhtrang_id=1;
        $dathang->ngaydathang=Carbon::now();
        $dathang->tongtien=$data['chiphi'] ? $giohang->gia + $data['chiphi']  : $giohang->gia;
        if ($dathang->save()) {


            foreach ($giohang->items as $sanpham_id => $item) {
                $dathang_chitiet = new dathang_chitiet;
                $soluong = $item['soluong'];
                $gia = $item['gia'];
                $dathang_chitiet->dathang_id = $dathang->id;
                $dathang_chitiet->sanpham_id = $sanpham_id;
                $dathang_chitiet->soluong = $soluong;
                $dathang_chitiet->dongia = $gia * $soluong;
                if ($dathang_chitiet->save()) {
                    $sanpham = sanpham::find($sanpham_id);
                    if ($sanpham->soluong >= $soluong) {
                        $sanpham->soluong -= $soluong;
                        $sanpham->save();
                    } else {
                        $xoahoadon = dathang::find($dathang->id);
                        $xoahoadon->delete();
                        return redirect()->back()->with('no', 'số lượng không đủ');
                    }
                }
            }
            $kh = Auth::guard('khachhang')->user();
            Mail::send('gmail.donhang', compact('kh'), function ($email) use ($kh) {
                $email->subject('GPM - Đặt hàng thành công');
                $email->to($kh->email, $kh->hoten);
            });

            session()->forget('phi');
           
            session()->forget('giohang');
            return redirect()->back();
        }
    }
    public function thanhcong()
    {
        session()->forget('giohang');
        return view('thanhcong');
    }
    //
    public function myorder()
    {
        $id=Auth::guard('khachhang')->user()->id;
        $od=dathang::where('khachhang_id', $id)->orderby('id','DESC')->get();
        return view('myorder',compact('od'));
    }
    public function myorder_detail($id){
        $od=dathang_chitiet::where('dathang_id',$id)->orderby('dathang_id','DESC')->get();
        $dathang=dathang::find($id);
       return view('myorder_detail',compact('od','dathang'));

    }
}
