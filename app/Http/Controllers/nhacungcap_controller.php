<?php

namespace App\Http\Controllers;

use App\Models\nhacungcap;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class nhacungcap_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.nhacungcap.index');
    }

    public function ds()
    {
        $nhacungcap=nhacungcap::orderBy('id','DESC')->GET();
        return response()->json([
            'nhacungcap'=>$nhacungcap,
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
            'nhacungcap'=>'required|max:191|unique:nhacungcap',
            
        ],
        [
            'nhacungcap.required' => 'Nhà cung cấp không được bỏ trống',
            'nhacungcap.unique' => 'Nhà cung cấp không được trùng',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $nhacungcap = new nhacungcap;
            $nhacungcap->nhacungcap = $request->input('nhacungcap');
            $nhacungcap->slug=Str::slug($nhacungcap->nhacungcap);
            $nhacungcap->save();
            return response()->json([
                'code'=>200,
                'mess' => 'Thêm thành công !',
            ]);
        }
       
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nhacungcap  $nhacungcap
     * @return \Illuminate\Http\Response
     */
    public function show(nhacungcap $nhacungcap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nhacungcap  $nhacungcap
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $nhacungcap = nhacungcap::find($id);
        if($nhacungcap)
        {
            return response()->json([
                'status'=>200,
                'nhacungcap'=> $nhacungcap,
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
     * @param  \App\Models\nhacungcap  $nhacungcap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'nhacungcap'=>'required|max:191',
            
        ],
        [
            'nhacungcap.required' => 'Nhà cung cấp không được bỏ trống',
            
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $nhacungcap = nhacungcap::find($id);
            if($nhacungcap)
            {
                $nhacungcap->nhacungcap = $request->input('nhacungcap');
                $nhacungcap->slug=Str::slug($nhacungcap->nhacungcap);
                $nhacungcap->update();
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
     * @param  \App\Models\nhacungcap  $nhacungcap
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $id=$request->id;
        $nhacungcap = nhacungcap::find($id);
        if($nhacungcap)
        {
            $nhacungcap->delete();
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
