<?php

namespace App\Http\Controllers;
use App\Models\chucvu;
use App\Models\nhanvien;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class nhanvien_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chucvu=chucvu::all();
        return view('admin.nhanvien.index',compact('chucvu'));
    }
    public function ds()
    {
        $nhanvien=nhanvien::all();
        $chucvu=chucvu::all();
        return response()->json([
            'nhanvien'=>$nhanvien,
            'chucvu'=>$chucvu,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hovaten' => 'required|string|max:255',
			'diachi' => 'required|string|max:255',
            'dienthoai' => 'required|numeric',
            'cmnd' => 'required|numeric',
            'tendangnhap' => 'required|string|max:255|unique:nhanvien',
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:nhanvien',
            'file_uploads' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            'dienthoai.max' => 'Số điện thoại không được vượt quá 10 ký tự',
            'cmnd.required' => 'CMND không được bỏ trống',
            'cmnd.max' => 'CMND không được vượt quá 12 ký tự',
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
            $nv=new nhanvien;
            $nv->hovaten=$request->hovaten;
            $nv->gioitinh=$request->gioitinh;
            $nv->ngaysinh=$request->ngaysinh;
            $nv->diachi=$request->diachi;
            $nv->dienthoai=$request->dienthoai;
            $nv->cmnd=$request->cmnd;
            $nv->chucvu_id=$request->chucvu_id;
            $nv->tendangnhap=$request->tendangnhap;
            $nv->password=bcrypt($request->password);
            $nv->email=$request->email;
           
    
            if($request->has('file_uploads')){
                $file=$request->file_uploads;
                $ex=$request->file_uploads->extension();
                $tenhinh=time().'.'.$request->hovaten.'.'.$ex;
                $file->move(public_path('nhanvien'), $tenhinh);
            }
            $request->merge(['anh'=>$tenhinh]);
            $nv->anh=$request->anh;
            
            if($nv->save()) {
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
     * @param  \App\Models\nhanvien  $nhanvien
     * @return \Illuminate\Http\Response
     */
    public function show(nhanvien $nhanvien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nhanvien  $nhanvien
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $nhanvien = nhanvien::find($id);
        if($nhanvien)
        {
            return response()->json([
                'status'=>200,
                'nhanvien'=> $nhanvien,
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
     * @param  \App\Models\nhanvien  $nhanvien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'hovaten' => 'required|string|max:255',
			'diachi' => 'required|string|max:255',
            'dienthoai' => 'required|numeric',
            'cmnd' => 'required|numeric',
            'tendangnhap' => 'required|string|max:255',
          
           
            'file_uploads' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            'dienthoai.max' => 'Số điện thoại không được vượt quá 10 ký tự',
            'cmnd.required' => 'CMND không được bỏ trống',
            'cmnd.max' => 'CMND không được vượt quá 12 ký tự',
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
          
            
            
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
            $nv = nhanvien::find($id);
            if($nv)
            {
                $nv->hovaten=$request->hovaten;
                $nv->gioitinh=$request->gioitinh;
                $nv->ngaysinh=$request->ngaysinh;
                $nv->diachi=$request->diachi;
                $nv->dienthoai=$request->dienthoai;
                $nv->cmnd=$request->cmnd;
                $nv->chucvu_id=$request->chucvu_id;
                $nv->tendangnhap=$request->tendangnhap;
                if(!empty($request->password))
                $nv->password=bcrypt($request->password);
                $nv->email=$request->email;
               
        
                if($request->has('file_uploads')){
                    $file=$request->file_uploads;
                    $ex=$request->file_uploads->extension();
                    $tenhinh=time().'.'.$request->nhanvien.'.'.$ex;
                    $file->move(public_path('nhanvien'), $tenhinh);
                
                    File::delete('public/nhanvien/'.$nv->anh);
                    $request->merge(['anh'=>$tenhinh]);
                    $nv->anh=$request->anh;
                }
                $nv->save();
                
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
     * @param  \App\Models\nhanvien  $nhanvien
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $id=$request->id;
        $nhanvien = nhanvien::find($id);
        $duongdan = 'public/nhanvien';
        File::delete($duongdan.'/'.$nhanvien->anh);
        if($nhanvien)
        {
            $nhanvien->delete();
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
