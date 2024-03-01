<?php

namespace App\Http\Controllers;

use App\Models\thanhpho;
use App\Models\huyen;
use App\Models\xa;
use App\Models\phivanchuyen;
use Illuminate\Http\Request;

class phivanchuyen_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phivanchuyen = phivanchuyen::all();
        $thanhpho = thanhpho::all();
        $huyen = huyen::all();
        $xa = xa::all();
        return view('admin.phivanchuyen.index', compact('phivanchuyen', 'thanhpho', 'huyen', 'xa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $thanhpho = thanhpho::orderby('mathanhpho', 'ASC')->get();
        $huyen = huyen::all();
        $xa = xa::all();
        return view('admin.phivanchuyen.create', compact('thanhpho', 'huyen', 'xa'));
    }

    public function chon(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "thanhpho") {
                $chon_huyen = huyen::where('mathanhpho', $data['mathanhpho'])->orderby('mahuyen', 'ASC')->get();
                $output .= '<option>-- Chọn Huyện --</option>';
                foreach ($chon_huyen as $item) {
                    $output .= '<option value="' . $item->mahuyen . '">' . $item->tenhuyen . '</option>';
                }
            } else {
                $chon_xa = xa::where('mahuyen', $data['mathanhpho'])->orderby('maxa', 'ASC')->get();
                $output .= '<option>-- Chọn Xã --</option>';
                foreach ($chon_xa as $item) {
                    $output .= '<option value="' . $item->maxa . '">' . $item->tenxa . '</option>';
                }
            }
        }
        echo $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }
    public function hien(Request $request)
    {
        $vanchuyen = vanchuyen::orderby('id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
        <table class="table table-bordered">
            <thread> 
                <tr>
                    <th> Tên Tĩnh </th>
                    <th> Tên huyện </th>
                    <th> Tên xã </th>
                    <th> Phí vấn chuyển </th>
                </tr>
            </thread>
            <tbody>
            ';
        foreach ($vanchuyen as $item) {
            $output .= '
            <tr>
                <td>' . $item->tinh->tentinh . '</td>
                <td>' . $item->huyen->tenhuyen . '</td>
                <td>' . $item->xa->tenxa . '</td>
                <td contenteditable data-id="' . $item->id . '" class="sotien_sua">' . number_format($item->sotien) .'<u>đ</u></td>
            </tr>
            ';
        }
        $output .= '
            </tbody>

            </table>
            </div>
            ';

        echo $output;
    }
    public function them(Request $request)
    {
       
        $vanchuyen = new phivanchuyen();
        $vanchuyen->thanhpho_id = $request->thanhpho;
        $vanchuyen->huyen_id =$request->huyen ;
        $vanchuyen->xa_id = $request->xa;
        $vanchuyen->phi = $request->phi ;
        $vanchuyen->save();
        return redirect('admin/phivanchuyen');
    }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vanchuyen  $vanchuyen
     * @return \Illuminate\Http\Response
     */
    public function show(vanchuyen $vanchuyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vanchuyen  $vanchuyen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vanchuyen = phivanchuyen::find($id);
        return view('admin.phivanchuyen.edit',compact('vanchuyen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vanchuyen  $vanchuyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vanchuyen = phivanchuyen::find($id);
        $vanchuyen->phi = $request->phi ;
        $vanchuyen->save();
        return redirect('admin/phivanchuyen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vanchuyen  $vanchuyen
     * @return \Illuminate\Http\Response
     */
    public function destroy(vanchuyen $vanchuyen)
    {
        //
    }
    public function delete($id)
    {
        $vanchuyen = vanchuyen::find($id);
        if ($vanchuyen->delete()) {
            return redirect()->back();
        }
    }
}
