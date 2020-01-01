<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class Page_KhoaHocController extends Controller
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

    public function getKhoaHoc(){
        $khoahocs = DB::table('khoahoc')->where('TrangThai',1)->orderBy('id','asc')->paginate(9);
        return view('web_pages.pages.khoahoc.khoahoc')->with(compact('khoahocs'));
    }

    public function getKhoaHocById($id){
        $baihoc = DB::table('baihoc')->where('idKhoaHoc',$id)->where('TrangThai',1)->paginate(9);
        return view('web_pages.pages.khoahoc.khoahocbyid')
            ->with(compact('baihoc'))
            ->with(compact('id'));
    }

    public function getDangKiKhoaHoc($id){
        $dangkikhoahoc = DB::table('khoahoc')->where('id',$id)->where('TrangThai',1)->orderBy('id','asc')->first();
        $binhluan = DB::table('binhluan')
            ->select('binhluan.id','binhluan.NoiDung','binhluan.TrangThai','baihoc.TieuDe','baihoc.updated_at','users.name','binhluan.updated_at as bl_date')
            ->join('users','users.id','=','binhluan.idUser')
            ->join('baihoc','baihoc.id','=','binhluan.idBaiHoc')
            ->join('khoahoc','khoahoc.id','=','baihoc.idKhoaHoc')
            ->where('binhluan.TrangThai',1)
            ->where('khoahoc.id',$id)
            ->paginate(10);
        return view('web_pages.pages.khoahoc.dangkikhoahoc')
            ->with(compact('dangkikhoahoc'))
            ->with(compact('binhluan'));
    }

    public function getKhoaHocDaDangKi(){
        $user_id = Session::get('user_id');
        $dangkikhoahoc = DB::table('dangkikhoahoc')
            ->select('khoahoc.id','khoahoc.Ten','khoahoc.GiaKhoaHoc','users.name','khoahoc.HinhAnh','idKhoaHoc','dangkikhoahoc.id as idDKKH')
            ->join('khoahoc','khoahoc.id','=','dangkikhoahoc.idKhoaHoc')
            ->join('users','users.id','=','dangkikhoahoc.idUser')
            ->where('dangkikhoahoc.TrangThai',1)
            ->where('khoahoc.TrangThai',1)
            ->where('users.TrangThai',1)
            ->where('users.id',$user_id)
            ->orderBy('dangkikhoahoc.id','asc')->paginate(9);
        return view('web_pages.pages.khoahoc.khoahocdadangki')
            ->with(compact('dangkikhoahoc'));

    }

    public function getDangKi($id){
        $user_name = Session::get('user_name');
        $khoahocdangki = DB::table('khoahoc')
            ->where('TrangThai',1)
            ->where('id',$id)
            ->first();
        return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
            ->with(compact('khoahocdangki'))
            ->with(compact('user_name'));
    }

    public function postDangKi($id, Request $request){
        $check = 0;
        $user_id = Session::get('user_id');
        $user_name = Session::get('user_name');
        $khoahocdangki = DB::table('khoahoc')
            ->where('TrangThai',1)
            ->where('id',$id)
            ->first();
        $idKhoaHoc = DB::table('dangkikhoahoc')
            ->select('idKhoaHoc')
            ->where('TrangThai',1)
            ->where('idUser',$user_id)->get();
        if(count($idKhoaHoc)>0){
            foreach ($idKhoaHoc as $idKH){
                //var_dump($idKhoaHoc);
                if($idKH->idKhoaHoc==$id){
                    $check = 1;
                    break;
                }
            }
        }
        if ($check) {
            //da ton tai id user
            Session::put('error_message','Khóa học đã được đăng kí');
            return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                ->with(compact('khoahocdangki'))
                ->with(compact('user_name'))
                ->with(compact('check'));

        }
        else {
            //chưa có idUser them đi
            $nguoidung = DB::table('users')->where('TrangThai',1)->where('id',$user_id)->first();
            if($nguoidung->TaiKhoan < $khoahocdangki->GiaKhoaHoc){
                Session::put('error_message', 'Số tiền tài khoản không đủ đăng đí khóa học');
                return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                    ->with(compact('khoahocdangki'))
                    ->with(compact('user_name'));
            }else {
                $data = array();
                $data['idKhoaHoc'] = $id;
                $data['idUser'] = $user_id;
                $data['TrangThai'] = 1;
                $data['TongTien'] = $khoahocdangki->GiaKhoaHoc;



                if($khoahocdangki->GiaKhoaHoc!=0) {
                    $sotien = array();
                    $sotien['TaiKhoan'] = $nguoidung->TaiKhoan - $khoahocdangki->GiaKhoaHoc;
                    if (DB::table('users')->where('id', $user_id)->where('TrangThai', 1)->update($sotien)) {
                        if (DB::table('dangkikhoahoc')->insert($data)) {
                            Session::put('message', 'Khóa học đăng kí thành công');
                            return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                                ->with(compact('khoahocdangki'))
                                ->with(compact('user_name'));
                        } else {
                            Session::put('error_message', 'Khóa học đăng kí thất bại');
                            return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                                ->with(compact('khoahocdangki'))
                                ->with(compact('user_name'));
                        }
                    } else {
                        Session::put('error_message', 'Khóa học đăng kí thất bại 2');
                        return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                            ->with(compact('khoahocdangki'))
                            ->with(compact('user_name'));
                    }
                }else{
                    if (DB::table('dangkikhoahoc')->insert($data)) {
                        Session::put('message', 'Khóa học đăng kí thành công');
                        return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                            ->with(compact('khoahocdangki'))
                            ->with(compact('user_name'));
                    } else {
                        Session::put('error_message', 'Khóa học đăng kí thất bại 1');
                        return view('web_pages.pages.khoahoc.xacnhandangkikhoahoc')
                            ->with(compact('khoahocdangki'))
                            ->with(compact('user_name'));
                    }
                }
            }
        }
    }

    public function getXoaKhoaHoc($id){
        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('page/dangnhap');
        }
        else{
            $dk_khoahoc = DB::table('dangkikhoahoc')
                ->select('dangkikhoahoc.id','khoahoc.Ten','users.name')
                ->join('khoahoc','khoahoc.id','=','dangkikhoahoc.idKhoaHoc')
                ->join('users','users.id','=','dangkikhoahoc.idUser')
                ->where('dangkikhoahoc.TrangThai',1)
                ->where('khoahoc.TrangThai',1)
                ->where('users.TrangThai',1)
                ->where('dangkikhoahoc.id',$id)
                ->first();
            //var_dump($nguoidung);
            return view('web_pages.pages.khoahoc.xoakhoahoc')
                ->with(compact('dk_khoahoc'));
        }
    }

    public function postXoaKhoaHoc($id,Request $request){
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
                return redirect('page/xoakhoahoc/'.$id)
                    ->with(compact('nguoidung'));
            }else {
                $data = array();
                $data['TrangThai'] = 0;
                if (DB::table('dangkikhoahoc')->where('id', $id)->update($data)) {
                    $dangkikhoahoc = DB::table('dangkikhoahoc')
                        ->select('khoahoc.id', 'khoahoc.Ten', 'khoahoc.GiaKhoaHoc', 'users.name', 'khoahoc.HinhAnh', 'idKhoaHoc', 'dangkikhoahoc.id as idDKKH')
                        ->join('khoahoc', 'khoahoc.id', '=', 'dangkikhoahoc.idKhoaHoc')
                        ->join('users', 'users.id', '=', 'dangkikhoahoc.idUser')
                        ->where('dangkikhoahoc.TrangThai', 1)
                        ->where('khoahoc.TrangThai', 1)
                        ->where('users.TrangThai', 1)
                        ->where('users.id', $user_id)
                        ->orderBy('dangkikhoahoc.id', 'asc')->paginate(9);
                    Session::put('message', 'Xóa khóa học khỏi danh sách đã đăng kí thành công');
                    return redirect('page/khoahoc_user')
                        ->with(compact('dangkikhoahoc'));
                } else{
                    Session::put('error_message', 'Xóa khóa học thất bại');
                    return redirect('page/khoahoc_user')
                        ->with(compact('nguoidung'));
                }
            }
        }

    }


}
