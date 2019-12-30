<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Api_KhoaHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khoahoc_home = DB::table('khoahoc')->where('TrangThai',1)->orderBy('id','asc')->paginate(9);
        $baihoc_noibat = DB::table('baihoc')
            ->select('baihoc.id','baihoc.TieuDe','baihoc.HinhAnh')
            ->join('khoahoc','khoahoc.id','=','baihoc.idKhoaHoc')
            ->where('khoahoc.TrangThai',1)
            ->where('khoahoc.TraPhi',0)
            ->where('baihoc.TrangThai',1)
            ->where('NoiBat',1)->paginate(6);
        return response()->json(['khoahoc_home'=>$khoahoc_home->toArray(),'baihoc_noibat'=>$baihoc_noibat]);
//        return view('web_pages.pages.trangchu')
//            ->with(compact('khoahoc_home'))
//            ->with(compact('baihoc_noibat'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
