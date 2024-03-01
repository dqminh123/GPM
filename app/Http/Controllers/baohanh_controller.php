<?php

namespace App\Http\Controllers;

use App\Models\baohanh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class baohanh_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.baohanh.index');
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
    public function ds()
    {
        $baohanh=baohanh::orderBy('id','DESC')->GET();
        return response()->json([
            'baohanh'=>$baohanh,
        ]);
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
            'baohanh'=>'required|max:191|unique:baohanh'
            
        ],
        [
            'baohanh.required'=> 'Bảo hành không được bỏ trống',
            'baohanh.unique'=> 'Bảo hành hiện đã có',
        ],);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $baohanh = new baohanh;
            $baohanh->baohanh = $request->input('baohanh');
            $baohanh->save();
            return response()->json([
                'code'=>200,
                'mess' => 'Thêm bảo hành thành công !',
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function show(baohanh $baohanh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $baohanh = baohanh::find($id);
        if($baohanh)
        {
            return response()->json([
                'status'=>200,
                'baohanh'=> $baohanh,
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
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'baohanh'=> 'required|max:191|unique:baohanh',
        ],
        [
            'baohanh.required'=> 'Bảo hành không được bỏ trống',
            'baohanh.unique'=> 'Bảo hành không được trùng',
        ],);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $baohanh = baohanh::find($id);
            if($baohanh)
        {
            $baohanh->baohanh = $request->input('baohanh');
           
            $baohanh->update();
            return response()->json([
                'code'=>200,
                'mess'=>'Cập nhật thành công.'
            ]);
        }
        else
        {
            return response()->json([
                'code'=>404,
                'mess'=>'Cập nhật không thành công .'
            ]);
        }

        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id = $request->id;
        $baohanh = baohanh::find($id);
        if($baohanh)
        {
            $baohanh->delete();
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
