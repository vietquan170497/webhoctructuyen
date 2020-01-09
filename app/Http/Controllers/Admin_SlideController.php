<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;


class Admin_SlideController extends Controller
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
        return view('admin.slide.them');
    }
    public function getDanhSach(){
        $this->AuthLogin();
        $slides = DB::table('slide')->orderBy('id','desc')->paginate(9);

        return view('admin.slide.danhsach')->with('slides',$slides);
    }

    public function postThem(Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'TieuDe'=>'required',
                'HinhAnh'=>'required',
                'NoiDung'=>'required',
                'link'=>'required',
            ],
            [
                'TieuDe.required'=>'Bạn chưa điền tiêu đề slide',
                'HinhAnh.required'=>'Bạn chưa chọn hình ảnh',
                'NoiDung.required'=>'Bạn chưa nhập tóm tắt',
                'link.required'=>'Bạn chưa nhập tóm tắt',
            ]);
        $data = array();
        $data['TieuDe'] = $request->TieuDe;
        $data['NoiDung'] = $request->NoiDung;
        $data['link'] = $request->link;

        $get_hinhanh = $request->file('HinhAnh');
        if($get_hinhanh){
            $duoi = $get_hinhanh->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'JPG' && $duoi != 'PNG' && $duoi != 'JPEG'){
                return redirect('admin/slide/them')->with('loi','Bạn chỉ chọn file có đuôi jpg, png, jpeg');
            }
            $size = $get_hinhanh->getClientSize();
//            if($size>=1000000){
//                return redirect('admin/khoahoc/sua')->with('size','Bạn chỉ chọn file dưới 1Mb');
//            }
            $name = $get_hinhanh->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $get_hinhanh->move("upload/slide/",$hinh);
            $data['HinhAnh'] = $hinh;
        }else{
            $data['HinhAnh'] = "";
        }

        DB::table('slide')->insert($data);

        return redirect('admin/slide/them')->with('message','Bạn thêm thành công');
    }

    public function getSua($id){
        $this->AuthLogin();
        $slides = DB::table('slide')->where('id',$id)->get();
        return view('admin.slide.sua')->with('slides',$slides);
    }

    public function postSua($id, Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'TieuDe'=>'required',
                'NoiDung'=>'required',
                'link'=>'required',
            ],
            [
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
                'link.required'=>'Bạn chưa nhập link',
            ]);

        $data = array();
        $data['TieuDe'] = $request->TieuDe;
        $data['NoiDung'] = $request->NoiDung;
        $data['link'] = $request->link;

        $hinhanh_old = "";
        $get_hinhanh = $request->file('HinhAnh');
        if($get_hinhanh){
            $duoi = $get_hinhanh->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'JPG' && $duoi != 'PNG' && $duoi != 'JPEG'){
                return redirect('admin/slide/sua')->with('loi','Bạn chỉ chọn file có đuôi jpg, png, jpeg');
            }
            $name = $get_hinhanh->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $slide = DB::table('slide')->where('id',$id)->first();
            $hinhanh_old = $slide->HinhAnh;
            $get_hinhanh->move("upload/slide/",$hinh);
            $data['HinhAnh'] = $hinh;
        }

        if(DB::table('slide')->where('id',$id)->update($data)){
            if($hinhanh_old!=""){
                unlink('upload/slide/'.$hinhanh_old);
            }
            return redirect('admin/slide/danhsach')->with('message','Bạn sửa thành công');
        }
        else{
            return redirect('admin/slide/danhsach')->with('error_message','Bạn sửa thất bại');
        }

    }
    public function getXoa($id){
        $this->AuthLogin();
        DB::table('slide')->where('id',$id)->delete();
        Session::put('message','Slide với id = '.$id.' xóa thành công');
        return Redirect::to('admin/slide/danhsach');
    }

}
