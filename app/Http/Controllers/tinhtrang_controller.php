<?php

namespace App\Http\Controllers;

use App\Models\tinhtrang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class tinhtrang_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tinhtrang.index');
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
        $tinhtrang=tinhtrang::orderBy('id','DESC')->GET();
        return response()->json([
            'tinhtrang'=>$tinhtrang,
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
            'tinhtrang'=>'required|max:191|unique:tinhtrang',
            
        ],
        [
            'tinhtrang.required' => 'Tình trạng không được bỏ trống',
            'tinhtrang.unique' => 'Tình trạng không được trùng',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $tinhtrang = new tinhtrang;
            $tinhtrang->tinhtrang = $request->input('tinhtrang');
            $tinhtrang->save();
            return response()->json([
                'code'=>200,
                'mess' => 'Thêm thành công !',
            ]);
        }
        
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tinhtrang  $tinhtrang
     * @return \Illuminate\Http\Response
     */
    public function show(tinhtrang $tinhtrang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tinhtrang  $tinhtrang
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $tinhtrang = tinhtrang::find($id);
        if($tinhtrang)
        {
            return response()->json([
                'status'=>200,
                'tinhtrang'=> $tinhtrang,
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
     * @param  \App\Models\tinhtrang  $tinhtrang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'tinhtrang'=>'required|max:191|unique:tinhtrang',
            
        ],
        [
            'tinhtrang.required' => 'Tình trạng không được bỏ trống',
            'tinhtrang.unique' => 'Tình trạng không được trùng',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $tinhtrang = tinhtrang::find($id);
            if($tinhtrang)
            {
                $tinhtrang->tinhtrang = $request->input('tinhtrang');
               
                $tinhtrang->update();
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
     * @param  \App\Models\tinhtrang  $tinhtrang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $tinhtrang = tinhtrang::find($id);
        if($tinhtrang)
        {
            $tinhtrang->delete();
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
