<?php

namespace App\Http\Controllers;

use App\Models\khachhang;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class khachhang_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.khachhang.index');
    }

    public function ds()
    {
        $khachhang=khachhang::all();
        return response()->json([
            'khachhang'=>$khachhang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'hovaten' => 'required|string|max:255',
			'diachi' => 'required|string|max:255',
            'dienthoai' => 'required|numeric',
            'tendangnhap' => 'required|string|max:255|unique:khachhang',
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:khachhang',
            'file_uploads' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            'dienthoai.max' => 'Số điện thoại không được vượt quá 10 ký tự',
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'file_uploads.required'  => 'Ảnh không được bỏ trống',
            'file_uploads.image'  => 'Vui lòng chọn tệp là hình ảnh',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $kh=new khachhang;
            $kh->hovaten=$request->hovaten;
            $kh->gioitinh=$request->gioitinh;
            $kh->diachi=$request->diachi;
            $kh->dienthoai=$request->dienthoai;
            $kh->tendangnhap=$request->tendangnhap;
            $kh->password=bcrypt($request->password);
            $kh->email=$request->email;
           
    
            if($request->has('file_uploads')){
                $file=$request->file_uploads;
                $ex=$request->file_uploads->extension();
                $tenhinh=time().'.'.$request->khachhang.'.'.$ex;
                $file->move(public_path('khachhang'), $tenhinh);
            }
            $request->merge(['anh'=>$tenhinh]);
            $kh->anh=$request->anh;
            if($kh->save()) {
                return response()->json([
                    'code'=>200,
                    'mess' => 'Thêm thành công !',
                ]);
            }
        }
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function show(khachhang $khachhang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $khachhang = khachhang::find($id);
        if($khachhang)
        {
            return response()->json([
                'status'=>200,
                'khachhang'=> $khachhang,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'hovaten' => 'required|string|max:255',
			'diachi' => 'required|string|max:255',
            'dienthoai' => 'required|numeric',
            'tendangnhap' => 'required|string|max:255|unique:khachhang',
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:khachhang',
            'file_uploads' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            'dienthoai.max' => 'Số điện thoại không được vượt quá 10 ký tự',
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'file_uploads.required'  => 'Ảnh không được bỏ trống',
            'file_uploads.image'  => 'Vui lòng chọn tệp là hình ảnh',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $kh = khachhang::find($id);
            if($kh)
            {
                $kh->hovaten=$request->hovaten;
                $kh->gioitinh=$request->gioitinh;
                $kh->diachi=$request->diachi;
                $kh->dienthoai=$request->dienthoai;
                $kh->tendangnhap=$request->tendangnhap;
                if(!empty($request->password))
                $kh->password=bcrypt($request->password);
                $kh->email=$request->email;
               
        
                if($request->has('file_uploads')){
                    $file=$request->file_uploads;
                    $ex=$request->file_uploads->extension();
                    $tenhinh=time().'.'.$request->khachhang.'.'.$ex;
                    $file->move(public_path('khachhang'), $tenhinh);
                
                    File::delete('public/khachhang/'.$kh->anh);
                    $request->merge(['anh'=>$tenhinh]);
                    $kh->anh=$request->anh;
                }
                $kh->save();
                
                return response()->json([
                    'code'=>200,
                    'mess'=>'Cập nhật thành công.'
                ]);
            }
            else
            {
                return response()->json([
                    'code'=>404,
                    'mess'=>'Cập nhật không thành công.'
                ]);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\khachhang  $khachhang
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $id=$request->id;
        $kh = khachhang::find($id);
        $duongdan = 'public/khachhang';
        File::delete($duongdan.'/'.$kh->anh);
        if($kh)
        {
            $kh->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }
    }
}
