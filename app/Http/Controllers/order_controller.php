<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dathang;
use App\Models\sanpham;
use App\Models\dathang_chitiet;
use App\Models\khachhang;
use App\Models\tinhtrang;
use Illuminate\Support\Facades\Auth;

class order_controller extends Controller
{
    //
    public function index()
    {
        $cdt=tinhtrang::all();
        $od=dathang::orderby('id','DESC')->paginate(10);
        return view('admin.order.index',compact('od','cdt'));
    }

    public function tinhtrang($id,$tt)
    {
        $od=dathang::find($id);
        $od->tinhtrang_id=$tt;
        $od->save();
        return redirect('admin/order');
    }

    public function show($id)
    {
        $od=dathang::find($id);
        $tinhtrang=tinhtrang::all();
        return view('admin.order.show',compact('od','tinhtrang'));
    }

    public function destroy($id)
    {
        $data=dathang_chitiet::where('dathang_id',$id)->delete();
        dathang::find($id)->delete();
        return redirect()->back();
    }

    public function nhandon($id){
        $data=dathang::find($id);
        $data->nhanvien_id=Auth::user()->id;
        $data->save();
        return redirect()->back();

    }
}
