<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class Page_UserController extends Controller
{
    //
    public function __construct()
    {
        $loaikhoahoc = DB::table('loaikhoahoc')->where('TrangThai',1)->orderBy('id','asc')->get();
        $khoahoc = DB::table('khoahoc')->where('TrangThai',1)->orderBy('id','asc')->get();
        $slide = DB::table('slide')->get();
        view()->share(compact('loaikhoahoc'));
        view()->share(compact('khoahoc'));
        view()->share(compact('slide'));

    }
    public function getDangNhap(){
        return view('web_pages.pages.user.dangnhap');
    }

    public function postDangNhap(Request $request){
        $this->validate($request,
            [
                'email'=>'required|email',
                'password'=>'required',
            ],
            [
                'email.required'=>'Email không được để trống',
                'email.email'=>'Phải nhập đúng định dạng email',
                'password.required'=>'Mật khẩu không được để trống',
            ]);

        $user = DB::table('users')
            ->where('TrangThai',1)
            ->where('email',$request->email)
            ->where('password',md5($request->password))->first();

        if($user){
            Session::put('user_id',$user->id);
            Session::put('user_email',$user->email);
            Session::put('user_name',$user->name);
            Session::put('user_TaiKhoan',$user->TaiKhoan);
            return redirect('page/home');
        }
        else{
            return redirect('page/dangnhap')->with('error_message','Sai email hoặc mật khẩu mời nhập lại!');
        }
    }

    public function getDangXuat(){
        Session::put('user_id',null);
        Session::put('user_email',null);
        Session::put('user_name',null);
        Session::put('user_TaiKhoan',null);

        return redirect('page/dangnhap')->with('dangxuat','Quý khách đăng xuất thành công, mời đăng nhập lại!');
    }

    public function getDangKi(){
        return view('web_pages.pages.user.dangki');
    }
    public function postDangKi(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3|max:50',
                'email'=>'required|email',
                'password'=>'required|min:3|max:50',
                'password2'=>'required|min:3|max:50|same:password',
            ],
            [
                'name.required'=>'Tên người dùng không được để trống',
                'name.min'=>'Tên người dùng ít nhất 3 kí tự',
                'name.max'=>'Tên người dùng nhiều nhất 50 kí tự',
                'email.required'=>'Email không được để trống',
                'email.email'=>'Phải nhập đúng định dạng email',
                'password.required'=>'Mật khẩu không được để trống',
                'password.min'=>'Mật khẩu ít nhất 3 kí tự',
                'password.max'=>'Mật khẩu nhiều nhất 50 kí tự',
                'password2.required'=>'Nhập lại mật khẩu không được để trống',
                'password2.min'=>'Nhập lại mật khẩu ít nhất 3 kí tự',
                'password2.max'=>'Nhập lại mật khẩu nhiều nhất 50 kí tự',
                'password2.same'=>'Nhập lại mật khẩu không giống với mật khẩu',
            ]);

        $nguoidung = DB::table('users')
            ->where('email',$request->email)
            ->where('TrangThai',1)->get();
        //var_dump($nguoidung); exit();
        if(count($nguoidung)>0){
            Session::put('tontai','Email bạn đăng kí đã tồn tại');
            return redirect('page/dangki');
        }else {
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = md5($request->password);
            $data['TaiKhoan'] = 0;
            $data['TrangThai'] = 1;
            if (DB::table('users')->insert($data)) {
                return redirect('page/dangki')->with('message', 'Bạn đăng kí thành công, mời đăng nhập');
            } else {
                return redirect('page/dangki')->with('error_message', 'Bạn thêm thất bại');
            }
        }
    }

    public function getTaiKhoan(){
        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }
        else{
            $nguoidung = DB::table('users')->where('TrangThai',1)->where('id',$user_id)->first();
            //var_dump($nguoidung);
            return view('web_pages.pages.user.taikhoan')
                ->with(compact('nguoidung'));
        }

        //return view('web_pages.pages.user.taikhoan');
    }

    public function postTaiKhoan(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3|max:50',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng phải có độ dài ít nhất 3 kí tự',
                'name.max'=>'Tên người dùng phải có độ dài nhiều nhất 50 kí tự',
            ]);
        if($request->changePassword == "on"){
            $this->validate($request,
                [
                    'matkhaucu'=>'required|min:3|max:50',
                    'matkhaumoi1'=>'required|min:3|max:50',
                    'matkhaumoi2'=>'required|min:3|max:50|same:matkhaumoi1',
                ],
                [
                    'matkhaucu.required'=>'Bạn chưa nhập mật khẩu cũ',
                    'matkhaucu.min'=>'Mật khẩu cũ phải có ít nhất 3 kí tự',
                    'matkhaucu.max'=>'Mật khẩu cũ chỉ có tối đa 50 kí tự',
                    'matkhaumoi1.required'=>'Bạn chưa nhập mật khẩu mới',
                    'matkhaumoi1.min'=>'Mật khẩu mới phải có ít nhất 3 kí tự',
                    'matkhaumoi1.max'=>'Mật khẩu mới chỉ có tối đa 50 kí tự',
                    'matkhaumoi2.required'=>'Bạn chưa nhập lại mật khẩu mới',
                    'matkhaumoi2.min'=>'Mật khẩu nhập lại phải có ít nhất 3 kí tự',
                    'matkhaumoi2.max'=>'Mật khẩu nhập lại chỉ có tối đa 50 kí tự',
                    'matkhaumoi2.same'=>'Mật khẩu nhập lại không đúng',
                ]);
        }

        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }else{
            $nguoidung = DB::table('users')->where('TrangThai',1)->where('id',$user_id)->first();
            if($request->changePassword == "on"){
                if($nguoidung->password != md5($request->matkhaucu) ) {
                    Session::put('error_message', 'Mật khẩu cũ bị sai mời nhập lại');
                    return view('web_pages.pages.user.taikhoan')
                        ->with(compact('nguoidung'));
                }else{
                    $data = array();
                    $data['name'] = $request->name;
                    $data['password'] = md5($request->matkhaumoi2);
                    if(DB::table('users')->where('id',$user_id)->update($data)){
                        $nguoidung = DB::table('users')->where('TrangThai',1)->where('id',$user_id)->first();
                        Session::put('message','Sửa tài khoản thành công');
                        return view('web_pages.pages.user.taikhoan')
                            ->with(compact('nguoidung'));
                    }else{
                        Session::put('error_message','Sửa tài khoản thất bại');
                        return view('web_pages.pages.user.taikhoan')
                            ->with(compact('nguoidung'));
                    }
                }
            }else{
                $data = array();
                $data['name'] = $request->name;
                if(DB::table('users')->where('id',$user_id)->update($data)){
                    $nguoidung = DB::table('users')->where('TrangThai',1)->where('id',$user_id)->first();
                    Session::put('message','Sửa tài khoản thành công');
                    return view('web_pages.pages.user.taikhoan')
                        ->with(compact('nguoidung'));
                }else{
                    Session::put('error_message','Sửa tài khoản thất bại');
                    return view('web_pages.pages.user.taikhoan')
                        ->with(compact('nguoidung'));
                }
            }
        }
    }

    public function getXoaTaiKhoan(){
        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }
        else{
            $nguoidung = DB::table('users')->where('id',$user_id)->where('TrangThai',1)->first();
            //var_dump($nguoidung);
            return view('web_pages.pages.user.xoataikhoan')
                ->with(compact('nguoidung'));
        }
    }

    public function postXoaTaiKhoan(Request $request){
        $this->validate($request,
            [
                'matkhaucu'=>'required|min:3|max:50',
                'matkhaucu2'=>'required|min:3|max:50|same:matkhaucu',
            ],
            [
                'matkhaucu.required'=>'Bạn chưa nhập mật khẩu ',
                'matkhaucu.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
                'matkhaucu.max'=>'Mật khẩu chỉ có tối đa 50 kí tự',
                'matkhaucu2.required'=>'Bạn chưa nhập lại mật khẩu',
                'matkhaucu2.min'=>'Mật khẩu nhập lại phải có ít nhất 3 kí tự',
                'matkhaucu2.max'=>'Mật khẩu nhập lại chỉ có tối đa 50 kí tự',
                'matkhaucu2.same'=>'Mật khẩu nhập lại không đúng',
            ]);

        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }else{
            $nguoidung = DB::table('users')
                ->where('TrangThai',1)
                ->where('id',$user_id)->first();
            if($nguoidung->password!=md5($request->matkhaucu2)){
                Session::put('error_message','Mật khẩu nhập không đúng');
                return view('web_pages.pages.user.xoataikhoan')
                    ->with(compact('nguoidung'));
            }else{
                $data = array();
                $data['TrangThai'] = 0;
                if(DB::table('users')->where('id',$user_id)->where('TrangThai',1)->update($data)){
                    Session::put('user_id',null);
                    Session::put('user_email',null);
                    Session::put('user_name',null);
                    Session::put('user_TaiKhoan',null);
                    Session::put('message','Xóa tài khoản thành công');
                    return redirect('page/dangki');
                }else{
                    Session::put('error_message','Xóa tài khoản thất bại');
                    return view('web_pages.pages.user.xoataikhoan')
                        ->with(compact('nguoidung'));
                }
            }
        }
    }

    public function getNapTien(){
        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }
        else{
            $nguoidung = DB::table('users')->where('id',$user_id)->where('TrangThai',1)->first();
            //var_dump($nguoidung);
            return view('web_pages.pages.user.naptien')
                ->with(compact('nguoidung'));
        }
    }
    public function postNapTien(Request $request){
        $this->validate($request,
            [
                'sotien'=>'required|integer|between:100000,100000000',
            ],
            [
                'sotien.required'=>'Bạn chưa nhập số tiền ',
                'sotien.integer'=>'Số tiền nhập phải là số',
                'sotien.between'=>'Số tiền nạp trong khoảng 100000 VNĐ đến 100 triệu VNĐ',
            ]);

        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }else{
            $nguoidung = DB::table('users')
                ->where('TrangThai',1)
                ->where('id',$user_id)->first();
            $data = array();
            $data['TaiKhoan'] = $nguoidung->TaiKhoan + $request->sotien;
            if(DB::table('users')->where('id',$user_id)->where('TrangThai',1)->update($data)){
                Session::put('message','Nạp tiền vào tài khoản thành công');
                return view('web_pages.pages.user.naptien')
                    ->with(compact('nguoidung'));
            }else{
                Session::put('error_message','Nạp tiền vào tài khoản thất bại');
                return view('web_pages.pages.user.naptien')
                    ->with(compact('nguoidung'));
            }

        }
    }

}

