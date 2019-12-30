@extends('web_pages.layout.index')
@section('content')
    <style>
        ::placeholder {
            color: #aaaaaa;
            font-weight: normal;
            opacity: 1; /* Firefox */
        }


    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2 style="font-weight: bold">Thông tin tài khoản người dùng</h2>

                    <?php
                    $error_message = Session::get('error_message');
                    if($error_message){
                        echo '<div class="alert alert-danger" style="text-align: center; font-size: 18px; font-weight: bold">'.$error_message.'</div>';
                        Session::put('error_message',null);
                        //$error_message = null;
                    }
                    $message = Session::get('message');
                    if($message){
                        echo '<div class="alert alert-success" style="text-align: center; font-size: 18px; font-weight: bold">'.$message.'</div>';
                        Session::put('message',null);
                    }

                    ?>
                    @if(count($errors)>0)
                        <div class="alert alert-danger" style="text-align: center;font-size: 16px; font-weight: bold">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <form action="page/taikhoan" method="post" name="myForm" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người dùng</label>
                            <input type="text" style="font-weight: bold; color: black; font-size: 18px; padding-left: 20px" placeholder="Nhâp tên người dùng" name="name" value="{{$nguoidung->name}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" name="email" disabled value="{{$nguoidung->email}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài khoản</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" name="TaiKhoan"  disabled value="{{$nguoidung->TaiKhoan}}" />
                        </div>
                        <label style=" padding: 0px;margin: 0px">Đổi mật khẩu</label>
                        <input type="checkbox" id="changePass" name="changePassword" style="width: 18px; padding: 0px;margin: 0px">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu cũ</label>
                            <input type="password" class="password" style="font-weight: bold; color: #000000; font-size: 18px; padding-left: 20px;" name="matkhaucu"  disabled value="" placeholder="Nhâp mật khẩu cũ" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu mới</label>
                            <input type="password" class="password" style="font-weight: bold; color: #000000; font-size: 18px; padding-left: 20px" name="matkhaumoi1"  disabled value="" placeholder="Nhâp mật khẩu mới"  />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nhập lại mật khẩu mới</label>
                            <input type="password" class="password" style="font-weight: bold; color: #000000; font-size: 18px; padding-left: 20px" name="matkhaumoi2"  disabled placeholder="Nhập lại mật khẩu mới" />
                        </div>
                        <table>
                            <tr>
                                <td class="btn_hover"><input type="submit" id="btn_submit" class="btn btn-default " value="Sửa tài khoản"style="color: white; background-color: #fe980f; border: solid; font-weight: bold;margin-top: 22px; padding-left: 30px; padding-right: 30px;"></input></td>
                                <td ><a href="page/naptien" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default btn_hover">Nạp tiền</a></td>
                                <td ><a href="page/xoataikhoan" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default btn_hover">Xóa tài khoản</a></td>
                            </tr>
                        </table>
                    </form>

                </div><!--/login form-->
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#changePass").change(function () {
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else {
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
@endsection

