<?php

namespace App\Http\Controllers;

use App\Models\huyen;
use App\Models\thanhpho;
use App\Imports\HuyenImport;
use Illuminate\Http\Request;
use Excel;

class huyen_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $huyen = huyen::all();
        $thanhpho = thanhpho::all();
        return view('admin.huyen.index', compact('huyen', 'thanhpho'));
    }
    public function postNhap(Request $request)
    {
        Excel::import(new HuyenImport, $request->file('file_excel'));

        return redirect('admin/huyen');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\huyen  $huyen
     * @return \Illuminate\Http\Response
     */
    public function show(huyen $huyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\huyen  $huyen
     * @return \Illuminate\Http\Response
     */
    public function edit(huyen $huyen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\huyen  $huyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, huyen $huyen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\huyen  $huyen
     * @return \Illuminate\Http\Response
     */
    public function destroy(huyen $huyen)
    {
        //
    }
}
