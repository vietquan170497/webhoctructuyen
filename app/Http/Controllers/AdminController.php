<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    //
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin/dashboard');
        } else{
            return Redirect::to('admin/login')->send();
        }
    }

    public function getLogin(){
        return view('admin.login');
    }

    public function getIndex(){
        $this->AuthLogin();
        return view('admin.index');
    }

    public function getDashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function postDashboard(Request $request){
        $email = $request->email;
        $password = md5($request->password);

        $result = DB::table('admin')->where('email',$email)->where('password',$password)->first();
        if( isset( $result)){
            Session::put('admin_name',$result->name);
            Session::put('admin_id',$result->id);
            return redirect('admin/dashboard');
        }
        else{
            Session::put('message',"Username hoặc password bị sai");
            return Redirect::to('admin/login');
        }
    }
    public function getLogout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('admin/login');
    }
    public function getInfo($id){
        $this->AuthLogin();
        $admin_info = DB::table('admin')->where('id',$id)->first();
        return view('admin.admin.info')->with('admin_info',$admin_info);
    }
    public function getEdit($id){
        $this->AuthLogin();
        $admin_info = DB::table('admin')->where('id',$id)->first();
        return view('admin.admin.edit')->with('admin_info',$admin_info);
    }
    public function postEdit($id, Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'name'=>'required',
                'phone'=>'required|regex:/^([0\s\-\+\(\)][0-9\s\-\+\(\)]*)$/|min:10|max:10',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên admin',
                'phone.required'=>'Bạn chưa nhập số điện thoại',
                'phone.regex'=>'Bạn phải nhập đúng dạng số điện thoại re',
                'phone.min'=>'Bạn phải nhập đúng dạng số điện thoại min',
                'phone.max'=>'Bạn phải nhập đúng dạng số điện thoại max',

            ]);
        if($request->ChangePass==1){
            $this->validate($request,
                [
                    'password'=>'required|min:4',
                ],[
                    'password.required'=>'Bạn chưa nhập mật khẩu',
                    'password.min'=>'Mật khẩu phải ít nhất 4 kí tự',
                ]);
        }

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        if($request->ChangePass == 1){
            $data['password'] = md5($request->password);
        }

        if(DB::table('admin')->where('id',$id)->update($data)){
            return redirect('admin/info/'.$id)->with('message','Bạn sửa thành công');
        } else{
            return redirect('admin/edit/'.$id)->with('loi','Bạn sửa thất bại');
        }

    }
}
