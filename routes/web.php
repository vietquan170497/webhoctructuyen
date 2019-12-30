<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('layoutindex',function (){
    return view('web_pages.pages.trangchu');
});

Route::get('admin/login','AdminController@getLogin');
Route::get('admin/', 'AdminController@getLogin');
Route::get('admin/dashboard', 'AdminController@getDashboard');
Route::post('admin/dashboard','AdminController@postDashboard');
Route::get('admin/logout','AdminController@getLogout');
Route::get('admin/info/{id}','AdminController@getInfo');
Route::get('admin/edit/{id}','AdminController@getEdit');
Route::post('admin/edit/{id}','AdminController@postEdit');

Route::get('home', function (){
    return view('web_pages/webpage');
});

//dang nhap nguoi dung
Route::post('dangnhap','PageApi_DangNhapController@store');
Route::get('dangnhap','PageApi_DangNhapController@index');

Route::group(['prefix'=>'admin'],function () {

    Route::get('dashboard','AdminController@getDashboard');

    Route::group(['prefix' => 'loaikhoahoc'], function () {
        // admin/loaikhoahoc/danhsach
        Route::get('danhsach','Admin_LoaiKhoaHocController@getDanhSach');
        Route::get('them','Admin_LoaiKhoaHocController@getThem');
        Route::post('them','Admin_LoaiKhoaHocController@postThem');

        Route::get('deactive/{id}','Admin_LoaiKhoaHocController@getDeactive');
        Route::get('active/{id}','Admin_LoaiKhoaHocController@getActive');

        Route::get('sua/{id}','Admin_LoaiKhoaHocController@getSua');
        Route::post('sua/{id}','Admin_LoaiKhoaHocController@postSua');
        Route::get('xoa/{id}','Admin_LoaiKhoaHocController@getXoa');
    });

    Route::group(['prefix' => 'khoahoc'], function () {
        // admin/khoahoc/danhsach
        Route::get('danhsach','Admin_KhoaHocController@getDanhSach');
        Route::get('them','Admin_KhoaHocController@getThem');
        Route::post('them','Admin_KhoaHocController@postThem');

        Route::get('deactive/{id}','Admin_KhoaHocController@getDeactive');
        Route::get('active/{id}','Admin_KhoaHocController@getActive');

        Route::get('sua/{id}','Admin_KhoaHocController@getSua');
        Route::post('sua/{id}','Admin_KhoaHocController@postSua');
        Route::get('xoa/{id}','Admin_KhoaHocController@getXoa');
    });

    Route::group(['prefix' => 'baihoc'], function () {
        // admin/baihoc/danhsach
        Route::get('danhsach','Admin_BaiHocController@getDanhSach');
        Route::get('them','Admin_BaiHocController@getThem');
        Route::post('them','Admin_BaiHocController@postThem');

        Route::get('deactive/{id}','Admin_BaiHocController@getDeactive');
        Route::get('active/{id}','Admin_BaiHocController@getActive');

        Route::get('sua/{id}','Admin_BaiHocController@getSua');
        Route::post('sua/{id}','Admin_BaiHocController@postSua');
        Route::get('xoa/{id}','Admin_BaiHocController@getXoa');
    });

    Route::group(['prefix' => 'user'], function () {
        // admin/baihoc/danhsach
        Route::get('danhsach','Admin_UserController@getDanhSach');
        Route::get('them','Admin_UserController@getThem');
        Route::post('them','Admin_UserController@postThem');

        Route::get('deactive/{id}','Admin_UserController@getDeactive');
        Route::get('active/{id}','Admin_UserController@getActive');

        Route::get('sua/{id}','Admin_UserController@getSua');
        Route::post('sua/{id}','Admin_UserController@postSua');
        Route::get('xoa/{id}','Admin_UserController@getXoa');
    });

    Route::group(['prefix' => 'slide'], function () {
        // admin/baihoc/danhsach
        Route::get('danhsach','Admin_SlideController@getDanhSach');
        Route::get('them','Admin_SlideController@getThem');
        Route::post('them','Admin_SlideController@postThem');

        Route::get('deactive/{id}','Admin_SlideController@getDeactive');
        Route::get('active/{id}','Admin_SlideController@getActive');

        Route::get('sua/{id}','Admin_SlideController@getSua');
        Route::post('sua/{id}','Admin_SlideController@postSua');
        Route::get('xoa/{id}','Admin_SlideController@getXoa');
    });

    Route::group(['prefix' => 'binhluan'], function () {
        Route::get('xoa/{id}','Admin_BinhLuanController@getXoa');
    });

    Route::group(['prefix' => 'dangkikhoahoc'], function () {
        // admin/baihoc/danhsach
        Route::get('danhsach','Admin_DangKiKhoaHocController@getDanhSach');
        Route::get('them','Admin_DangKiKhoaHocController@getThem');
        Route::post('them','Admin_DangKiKhoaHocController@postThem');

        Route::get('deactive/{id}','Admin_DangKiKhoaHocController@getDeactive');
        Route::get('active/{id}','Admin_DangKiKhoaHocController@getActive');

        Route::get('sua/{id}','Admin_DangKiKhoaHocController@getSua');
        Route::post('sua/{id}','Admin_DangKiKhoaHocController@postSua');
        Route::get('xoa/{id}','Admin_DangKiKhoaHocController@getXoa');
    });

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('khoahoc/{idLoai}','AjaxController@getKhoaHoc');
        Route::get('dangki/{idKhoaHoc}','AjaxController@getGiaKhoaHoc');
    });

//    Route::get('ajax/loaikhoahoc/{idLoai}','AjaxController@getKhoaHoc');
});
Route::group(['prefix'=>'page'],function () {

    // cac chuc nang tren page phan user
    Route::get('dangnhap','Page_UserController@getDangNhap');
    Route::post('dangnhap','Page_UserController@postDangNhap');
    Route::get('dangxuat','Page_UserController@getDangXuat');
    Route::get('dangki','Page_UserController@getDangKi');
    Route::post('dangki','Page_UserController@postDangKi');

    Route::get('taikhoan','Page_UserController@getTaiKhoan');
    Route::post('taikhoan','Page_UserController@postTaiKhoan');
    Route::get('naptien','Page_UserController@getNapTien');
    Route::post('naptien','Page_UserController@postNapTien');
    Route::get('xoataikhoan','Page_UserController@getXoaTaiKhoan');
    Route::post('xoataikhoan','Page_UserController@postXoaTaiKhoan');

    // cac chuc nang tren page phan trang chu
    Route::get('home','Page_HomeController@getHome');
    Route::get('loaikhoahoc/{id}','Page_HomeController@getLoaiKhoaHocById');
    Route::get('baihoc/{id}','Page_HomeController@getBaiHocById');
    Route::get('timkiem','Page_HomeController@getTimKiem');
    Route::get('lienhe','Page_HomeController@getLienHe');

    // cac chuc nang tren page phan khoa hoc
    Route::get('khoahoc','Page_KhoaHocController@getKhoaHoc');
    Route::get('khoahoc/{id}','Page_KhoaHocController@getKhoaHocById');
    Route::get('dangkikhoahoc/{id}','Page_KhoaHocController@getDangKiKhoaHoc');
    Route::get('khoahoc_user','Page_KhoaHocController@getKhoaHocUser');
    Route::get('dangkikhoahoc/dangki/{id}','Page_KhoaHocController@getDangKi');
    Route::post('dangkikhoahoc/dangki/{id}','Page_KhoaHocController@postDangKi');
    Route::get('xoakhoahoc/{id}','Page_KhoaHocController@getXoaKhoaHoc');
    Route::post('xoakhoahoc/{id}','Page_KhoaHocController@postXoaKhoaHoc');

    //binh luan
    Route::post('thembinhluan/{idBaiHoc}','Page_HomeController@postThem');
    Route::post('suabinhluan/{id}','Page_HomeController@postSua');
    Route::get('xoabinhluan/{id}','Page_HomeController@getXoa');





});


