<?php

namespace App\Http\Controllers;

use App\Models\thanhpho;
use App\Imports\TinhImport;
use Excel;
use Illuminate\Http\Request;

class thanhpho_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thanhpho = thanhpho::all();
        return view('admin.thanhpho.index', compact('thanhpho'));
    }

    public function postNhap(Request $request)
    {
        Excel::import(new TinhImport, $request->file('file_excel'));

        return redirect('admin/thanhpho');
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
     * @param  \App\Models\thanhpho  $thanhpho
     * @return \Illuminate\Http\Response
     */
    public function show(thanhpho $thanhpho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\thanhpho  $thanhpho
     * @return \Illuminate\Http\Response
     */
    public function edit(thanhpho $thanhpho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\thanhpho  $thanhpho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, thanhpho $thanhpho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\thanhpho  $thanhpho
     * @return \Illuminate\Http\Response
     */
    public function destroy(thanhpho $thanhpho)
    {
        //
    }
}
