<?php

namespace App\Http\Controllers;

use App\Models\chucvu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class chucvu_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.chucvu.index');
    }

    public function ds() {
        $chucvu=chucvu::orderBy('id','DESC')->GET();
        return response()->json([
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
            'tenchucvu'=>'required|max:191|unique:chucvu',
            'quyen' => 'required|string|max:100|'
        ],
        [
            'tenchucvu.required' => 'Tên chức vụ không được bỏ trống',
            'tenchucvu.unique' => 'Tên chức vụ không được trùng',
            'quyen.required' => 'Quyền không được bỏ trống',   
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $chucvu = new chucvu;
            $chucvu->tenchucvu = $request->input('tenchucvu');
            $chucvu->quyen = $request->input('quyen');
            $chucvu->save();
            return response()->json([
                'code'=>200,
                'mess' => 'Thêm thành công !',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chucvu  $chucvu
     * @return \Illuminate\Http\Response
     */
    public function show(chucvu $chucvu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chucvu  $chucvu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chucvu = chucvu::find($id);
        if($chucvu)
        {
            return response()->json([
                'status'=>200,
                'chucvu'=> $chucvu,
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
     * @param  \App\Models\chucvu  $chucvu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [
            'tenchucvu'=>'required|max:191|unique:chucvu',
            'quyen' => 'required|string|max:100|'
        ],
        [
            'tenchucvu.required' => 'Tên chức vụ không được bỏ trống',
            'tenchucvu.unique' => 'Tên chức vụ không được trùng',
            'quyen.required' => 'Quyền không được bỏ trống',   
        ],);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $chucvu = chucvu::find($id);
            if($chucvu)
            {
                $chucvu->tenchucvu = $request->input('tenchucvu');
                $chucvu->quyen = $request->input('quyen');
                $chucvu->update();
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
     * @param  \App\Models\chucvu  $chucvu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $chucvu = chucvu::find($id);
        if($chucvu)
        {
            $chucvu->delete();
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
