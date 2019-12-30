<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Api_NguoiDungController extends Controller
{
    public function __construct()
    {
        $loaikhoahoc = DB::table('loaikhoahoc')->where('TrangThai',1)->orderBy('id','asc')->get();
        $khoahoc = DB::table('khoahoc')->where('TrangThai',1)->orderBy('id','asc')->get();
        $slide = DB::table('slide')->get();
        view()->share(compact('loaikhoahoc'));
        view()->share(compact('khoahoc'));
        view()->share(compact('slide'));
    }

    public function index()
    {
        //
        $nguoidung = DB::table('users')->where('TrangThai',1)->orderBy('id','asc')->get();
        return response()->json($nguoidung);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('web_pages.pages.dangki');
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

        $data = array();
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        $data['TaiKhoan'] = 0;
        $data['TrangThai'] = 0;


        if(DB::table('users')->insert($data)){
            return response()->json(['data'=>$data],200);
        } else{
            return response()->json('Nguoidung Not Found',500);
        }
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
