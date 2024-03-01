<?php

namespace App\Http\Controllers;

use App\Models\danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use File;


class danhmuc_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dm=danhmuc::all();
        return view('admin.danhmuc.index',compact('dm'));
    }

    public function ds()
    {
        $danhmuc=danhmuc::all();
        return response()->json([
            'danhmuc'=>$danhmuc,
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
        
        $validator = Validator::make($request->all(), [
            'tendanhmuc' => 'required|string|max:100|unique:danhmuc',
        ],
        [
            'tendanhmuc.required' => 'Tên danh mục không được bỏ trống',
            'tendanhmuc.unique' => 'Tên danh mục không được trùng',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $dm=new danhmuc;
            $dm->tendanhmuc=$request->tendanhmuc;
            $dm->slug=str::slug($dm->tendanhmuc);
            $dm->trangthai=$request->trangthai;
           
           
    
            if($request->has('file_uploads')){
                $file=$request->file_uploads;
                $ex=$request->file_uploads->extension();
                $tenhinh=time().'.'.$request->danhmuc.'.'.$ex;
                $file->move(public_path('danhmuc'), $tenhinh);
            }
            $request->merge(['anh'=>$tenhinh]);
            $dm->anh=$request->anh;
            
            if($dm->save()) {
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
     * @param  \App\Models\danhmuc  $danhmuc
     * @return \Illuminate\Http\Response
     */
    public function show(danhmuc $danhmuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\danhmuc  $danhmuc
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $danhmuc = danhmuc::find($id);
        if($danhmuc)
        {
            return response()->json([
                'status'=>200,
                'danhmuc'=> $danhmuc,
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
     * @param  \App\Models\danhmuc  $danhmuc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'tendanhmuc' => 'required|string|max:100',
        ],
        [
            'tendanhmuc.required' => 'Tên danh mục không được bỏ trống',
            
        ],);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $danhmuc = danhmuc::find($id);
            if($danhmuc)
            {
                $danhmuc->tendanhmuc=$request->tendanhmuc;
                $danhmuc->slug=str::slug($danhmuc->tendanhmuc);
                $danhmuc->trangthai=$request->trangthai;
               
               
        
                if($request->has('file_uploads')){
                    $file=$request->file_uploads;
                    $ex=$request->file_uploads->extension();
                    $tenhinh=time().'.'.$request->danhmuc.'.'.$ex;
                    $file->move(public_path('danhmuc'), $tenhinh);
                
                    File::delete('public/danhmuc/'.$danhmuc->anh);
                    $request->merge(['anh'=>$tenhinh]);
                    $danhmuc->anh=$request->anh;
                }
                $danhmuc->save();
                
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
     * @param  \App\Models\danhmuc  $danhmuc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $danhmuc = danhmuc::find($id);
        $duongdan = 'public/danhmuc';
        File::delete($duongdan.'/'.$danhmuc->anh);
        if($danhmuc)
        {
            $danhmuc->delete();
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
