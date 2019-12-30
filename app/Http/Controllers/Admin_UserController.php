<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;


class Admin_UserController extends Controller
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
    public function getThem(){
        $this->AuthLogin();
        return view('admin.users.them');
    }
    public function getDanhSach(){
        $this->AuthLogin();
        $users = DB::table('users')->orderBy('id','asc')->paginate(9);

        return view('admin.users.danhsach')->with('users',$users);
    }

    public function postThem(Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'name'=>'required|min:3|max:50',
                'email'=>'required|email',
                'password'=>'required|min:3|max:50',
                'TaiKhoan'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa điền tên người dùng',
                'name.min'=>'Tên người dùng ít nhất 3 kí tự',
                'name.max'=>'Tên người dùng nhiều nhất 50 kí tự',
                'email.required'=>'Bạn chưa điền email',
                'email.email'=>'Bạn phải điền đúng định dạng email',
                'password.required'=>'Bạn chưa điền password',
                'password.min'=>'Password ít nhất 3 kí tự',
                'password.max'=>'Password nhiều nhất 50 kí tự',
                'TaiKhoan.required'=>'Bạn chưa điền tài khoản',
            ]);
        $nguoidung = DB::table('users')
            ->where('email',$request->email)
            ->where('TrangThai',1)->get();
        //var_dump($nguoidung); exit();
        if(count($nguoidung)>0){
            //Session::put('tontai','Email bạn đăng kí đã tồn tại');
            return redirect('admin/user/them')->with('error_message','Email bạn đăng kí đã tồn tại');
        }else {
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = md5($request->password);
            $data['TaiKhoan'] = $request->TaiKhoan;
            $data['TrangThai'] = $request->TrangThai;

            DB::table('users')->insert($data);

            //Session::put('message','Thêm loại khóa học thành công');
            return redirect('admin/user/them')->with('message','Bạn thêm thành công');
        }
    }
    public function getDeactive($id){
        $this->AuthLogin();
        $nguoidung1 = DB::table('users')->where('TrangThai',0)->where('id',$id)->first();
        $email = $nguoidung1->email;
        $nguoidung2 = DB::table('users')->where('TrangThai',1)->where('email',$email)->get();
        //var_dump($nguoidung2);exit();
        if(count($nguoidung2)>0){
            Session::put('error_message','Đã tồn tại email đang hiện');
            return Redirect::to('admin/user/danhsach');
        }else{
            DB::table('users')->where('id',$id)->update(['TrangThai'=>1]);
            Session::put('message','Trạng thái với id = '.$id.' được Hiện');
            return Redirect::to('admin/user/danhsach');
        }
    }

    public function getActive($id){
        $this->AuthLogin();
        DB::table('users')->where('id',$id)->update(['TrangThai'=>0]);
        Session::put('message','Trạng thái với id = '.$id.' được Ẩn');
        return Redirect::to('admin/user/danhsach');
    }

    public function getSua($id){
        $this->AuthLogin();
        $users = DB::table('users')->where('id',$id)->get();
        return view('admin.users.sua')->with('users',$users);
    }
    public function postSua($id, Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'name'=>'required',
                'TaiKhoan'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa điền tên người dùng',
                'TaiKhoan.required'=>'Bạn chưa điền tài khoản',
            ]);
        $data = array();
        $data['name'] = $request->name;
        $data['TaiKhoan'] = $request->TaiKhoan;
        if($request->changePassword == "on"){
            $this->validate($request,
                [
                    'password'=>'required|min:3|max:30',
                ],
                [
                    'password.required'=>'Bạn chưa nhập mật khẩu',
                    'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
                    'password.max'=>'Mật khẩu chỉ có tối đa 30 kí tự',
                ]);
            $data['password'] = md5($request->password);
        }

        if(DB::table('users')->where('id',$id)->update($data)){
            return redirect('admin/user/danhsach')->with('message','Người dùng với id = '.$id.' sửa thành công');
        }else{
            Session::put('error_message','Sửa thất bại');
            return redirect('admin/user/sua/'.$id);
        }
    }
    public function getXoa($id){
        $this->AuthLogin();
        if(DB::table('users')->where('id',$id)->delete()){
            Session::put('message','Người dùng với id = '.$id.' xóa thành công');
            return Redirect::to('admin/user/danhsach');
        }else{
            Session::put('error_message','xóa thất bại');
            return redirect('admin/user/danhsach');
        }
    }
}
