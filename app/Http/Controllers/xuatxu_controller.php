<?php

namespace App\Http\Controllers;

use App\Models\xuatxu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class xuatxu_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.xuatxu.index');
    }
    
    public function ds()
    {
        $xuatxu=xuatxu::orderBy('id','DESC')->GET();
        return response()->json([
            'xuatxu'=>$xuatxu,
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
            'tenxuatxu'=>'required|max:191|unique:xuatxu',
            
        ],
        [
            'tenxuatxu.required' => 'Tên xuất xứ không được bỏ trống',
            'tenxuatxu.unique' => 'Tên xuất xứ không được trùng',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $xuatxu = new xuatxu;
            $xuatxu->tenxuatxu = $request->input('tenxuatxu');
            $xuatxu->save();
            return response()->json([
                'code'=>200,
                'mess' => 'Thêm thành công !',
            ]);
        }
       
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function show(xuatxu $xuatxu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $xuatxu = xuatxu::find($id);
        if($xuatxu)
        {
            return response()->json([
                'status'=>200,
                'xuatxu'=> $xuatxu,
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
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'tenxuatxu'=>'required|max:191|unique:xuatxu',
            
        ],
        [
            'tenxuatxu.required' => 'Tên xuất xứ không được bỏ trống',
            'tenxuatxu.unique' => 'Tên xuất xứ không được trùng',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $xuatxu = xuatxu::find($id);
            if($xuatxu)
            {
                $xuatxu->tenxuatxu = $request->input('tenxuatxu');
               
                $xuatxu->update();
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
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $xuatxu = xuatxu::find($id);
        if($xuatxu)
        {
            $xuatxu->delete();
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
