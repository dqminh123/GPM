<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\sanpham;
use App\Models\dathang;
use App\Models\khachhang;
use App\Models\nhanvien;
use Illuminate\Support\Facades\Validator;

class admin_controller extends Controller
{
    //
    public function index()
    {   
        $sanpham_count = sanpham::count();
        $donhang_count = dathang::count();
        $khachhang_count= khachhang::count();
        $nhanvien_count= nhanvien::count();
        $dh=dathang::where('nhanvien_id',null)->get();
        if(request()->ngaybatdau && request()->ngayketthuc)
        {
            $dh1=dathang::where('tinhtrang_id',5)->whereBetween('ngaydathang',[request()->ngaybatdau,request()->ngayketthuc])->get();
            foreach($dh1 as $item)
            {
                $chart[]=array(
                    'id'=>$item->id,
                    'tongtien'=>$item->tongtien,
                    'ngaydathang'=>$item->ngaydathang,
                    'sum'=>$item->sum('tongtien'),  
                );
            }
                return response()->json([
                    'dh'=>$chart,
            ]);  

        }
        return view('admin.index', compact('sanpham_count','donhang_count','khachhang_count','nhanvien_count','dh'));
    }
    public function file()
    {
        return view('admin.file');
    }
    
    public function dangnhap(){
        return view('admin.dangnhap');
    }
    public function postdangnhap(Request $request){
        $validator = Validator::make($request->all(), [
            
            'tendangnhap' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ],
        [
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'code' => 500,
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            if(Auth::attempt(['tendangnhap'=>$request->tendangnhap, 'password'=>$request->password]))
            {
                return response()->json([
                    'code'=>200,
                    'mess' => 'Đăng nhập  thành công !',
                ]);
            }
            else
            {
               
                return response()->json([
                    'code'=>400,
                    'error' => 'Đăng nhập không thành công !',
                ]);
                
            }
        }
        
    }
    public function dangxuat(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
