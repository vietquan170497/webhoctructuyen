<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class Page_HomeController extends Controller
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
    public function AuthLogin(){
        $user_id = Session::get('user_id');
        if(!$user_id){
            return redirect('page/dangnhap')->send();
        }
    }

    public function getHome(){
        $khoahoc_home = DB::table('khoahoc')->where('TrangThai',1)->orderBy('id','DESC')->limit(9)->get();
        $baihoc_noibat = DB::table('baihoc')
            ->select('baihoc.id','baihoc.TieuDe','baihoc.HinhAnh')
            ->join('khoahoc','khoahoc.id','=','baihoc.idKhoaHoc')
            ->where('khoahoc.TrangThai',1)
            ->where('khoahoc.TraPhi',0)
            ->where('baihoc.TrangThai',1)
            ->where('NoiBat',1)->paginate(4);
        //var_dump($baihoc_noibat);
//        echo count($baihoc_noibat);
//        exit();
        return view('web_pages.pages.trangchu')
            ->with(compact('khoahoc_home'))
            ->with(compact('baihoc_noibat'));

    }

    public function getLoaiKhoaHocById($id){
        $loaikhoahocTen = DB::table('loaikhoahoc')->where('id',$id)->first();
        $loaikhoahocbyid = DB::table('khoahoc')->where('idLoaiKhoaHoc',$id)->where('TrangThai',1)->orderBy('id','asc')->paginate(9);
        return view('web_pages.pages.loaikhoahocbyid')
            ->with(compact('loaikhoahocTen'))
            ->with(compact('loaikhoahocbyid'));
    }

    public function getBaiHocById($id){
        $this->AuthLogin();
        $baihocbyid = DB::table('baihoc')
            ->select('baihoc.id','baihoc.TieuDe','baihoc.TomTat','baihoc.NoiDung','baihoc.HinhAnh','baihoc.Video','baihoc.NoiBat',
                'baihoc.SoLuotXem','baihoc.idKhoaHoc as idKhoaHoc','baihoc.TrangThai','baihoc.created_at','baihoc.updated_at')
            ->join('khoahoc','khoahoc.id','=','baihoc.idKhoaHoc')
            ->where('baihoc.id',$id)
            ->where('baihoc.TrangThai',1)
            ->where('khoahoc.TrangThai',1)
            ->first();
        if($baihocbyid) {
            $idKhoaHoc = $baihocbyid->idKhoaHoc;

            $baihoc_lienquan = DB::table('baihoc')
                ->where('baihoc.idKhoaHoc',$idKhoaHoc)
                ->where('baihoc.TrangThai',1)
                ->paginate(4);
            $binhluan = DB::table('binhluan')
                ->select('binhluan.id','binhluan.NoiDung','binhluan.TrangThai','baihoc.TieuDe','baihoc.updated_at','users.name')
                ->join('users','users.id','=','binhluan.idUser')
                ->join('baihoc','baihoc.id','=','binhluan.idBaiHoc')
                ->where('binhluan.TrangThai',1)
                ->where('baihoc.id',$id)
                ->paginate(10);
            //var_dump($binhluan); exit();
            $idBaiHoc = $id;
            return view('web_pages.pages.baihocbyid')
                ->with(compact('baihocbyid'))
                ->with(compact('baihoc_lienquan'))
                ->with(compact('binhluan'))
                ->with(compact('idBaiHoc'));}
        else{
            $idBaiHoc = $id;
            return view('web_pages.pages.baihocbyid')
                ->with(compact('baihocbyid'))->with(compact('idBaiHoc'));
        }
    }

    public function getLienHe()
    {
        return view('web_pages.pages.lienhe');
    }

    public function getTimKiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $tk_khoahoc = DB::table('khoahoc')
            ->where('TrangThai',1)
            ->where('Ten','like','%'.$tukhoa.'%')
            ->orWhere('TomTat','like','%'.$tukhoa.'%')
            ->paginate(9);
        return view('web_pages.pages.khoahoc.timkiem',['tk_khoahoc'=>$tk_khoahoc,'tukhoa'=>$tukhoa]);
    }

    public function postThem($idBaiHoc, Request $request){
        $this->validate($request,
            [
                'them_binhluan'=>'required',
            ],
            [
                'them_binhluan.required'=>'Bạn chưa nhập nội dung bình luận cần thêm',
            ]);
        $user_id = Session::get('user_id');
        if($user_id){
            $check = false;
            $noidung = DB::table('binhluan')
                ->select('NoiDung')
                ->where('TrangThai',1)
                ->get();
            foreach ($noidung as $nd){
                if($nd->NoiDung === $request->them_binhluan){
                    $check = true;
                    break;
                }
            }
            if($check){
                Session::put('error_message', 'Bình luận với nôi dung "'.$request->them_binhluan.'" đã tồn tại');
                return redirect('page/baihoc/'.$idBaiHoc);
            }else {
                $data = array();
                $data['idBaiHoc'] = $idBaiHoc;
                $data['idUser'] = $user_id;
                $data['NoiDung'] = $request->them_binhluan;
                $data['TrangThai'] = 1;

                if (DB::table('binhluan')->insert($data)) {
                    Session::put('message', 'Thêm bình luận thành công');
                    return redirect('page/baihoc/' . $idBaiHoc);
                } else {
                    Session::put('error_message', 'Thêm bình luận thất bại');
                    return redirect('page/baihoc/' . $idBaiHoc);
                }
            }
        }else{
            Session::put('error_message', 'Bạn chưa đăng nhập mời đăng nhập');
            return redirect('page/dangnhap');
        }
    }

    public function postSua($id, Request $request){
        $this->validate($request,
            [
                'sua_binhluan'=>'required',
            ],
            [
                'sua_binhluan.required'=>'Bạn chưa nhập nội dung bình luận cần sửa',
            ]);
        $user_id = Session::get('user_id');
        if(!$user_id){
            Session::put('error_message', 'Bạn chưa đăng nhập mời đăng nhập');
            return redirect('page/dangnhap');
        } else{
            $idBaiHoc = DB::table('binhluan')
                ->select('idBaiHoc')
                ->where('TrangThai',1)
                ->where('id',$id)->first();
            $binhluan = DB::table('binhluan')
                ->select('id as idBL','idBaiHoc', 'NoiDung')
                ->where('TrangThai',1)
                ->where('idUser',$user_id)
                ->where('idBaiHoc',$idBaiHoc->idBaiHoc)
                ->where('id','<>',$id)
                ->get();
            $check = false;
            foreach ($binhluan as $bl){
                if($bl->NoiDung === $request->sua_binhluan){
                    $check = true;
                    break;
                }
            }
            if($check) {
                Session::put('error_message', 'Bình luận với nôi dung "'.$request->sua_binhluan.'" đã tồn tại');
                return redirect('page/baihoc/'.$binhluan[0]->idBaiHoc);
            } else{
                $data = array();
                $data['NoiDung'] = $request->sua_binhluan;
                if(DB::table('binhluan')->where('id',$id)->update($data)){
                    Session::put('message', 'Bình luận nội dung mới "'.$request->sua_binhluan.'" sửa thành công');
                    return redirect('page/baihoc/'.$binhluan[0]->idBaiHoc);
                }
                else{
                    Session::put('error_message', 'Sửa bình luận thất bại');
                    return redirect('page/baihoc/'.$binhluan[0]->idBaiHoc);
                }
            }
        }
    }

    public function getXoa($id){
        $user_id = Session::get('user_id');
        if(!$user_id){
            Session::put('error_message', 'Bạn chưa đăng nhập mời đăng nhập');
            return redirect('page/dangnhap');
        }else{
            $binhluan = DB::table('binhluan')
                ->select('idBaiHoc','NoiDung')
                ->where('TrangThai',1)
                ->where('id',$id)->first();
            $noidung = $binhluan->NoiDung;
            if(DB::table('binhluan')->where('id',$id)->delete()){
                Session::put('message','Bình luận với nội dung "'.$noidung.'" xóa thành công');
                return redirect('page/baihoc/'.$binhluan->idBaiHoc);
            }else{
                Session::put('error_message', 'Xóa bình luận thất bại');
                return redirect('page/baihoc/'.$binhluan->idBaiHoc);
            }
        }
    }

}
