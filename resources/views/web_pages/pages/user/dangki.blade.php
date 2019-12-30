@extends('web_pages.layout.index')
@section('content')
    <style>
        .ul_validate{
            padding-left:0px ;
            padding-bottom: 10px;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2 style="font-weight: bold">Đăng kí tài khoản mới</h2>
                    <?php
                    $error_message = Session::get('error_message');
                    if($error_message){
                        echo '<div class="alert alert-danger" style="text-align: center;font-size: 16px; font-weight: bold">'.$error_message.'</div>';
                        Session::put('error_message',null);
                    }
                    $tontai = Session::get('tontai');
                    if($tontai){
                        echo '<div class="alert alert-danger" style="text-align: center;font-size: 16px; font-weight: bold">'.$tontai.'</div>';
                        Session::put('tontai',null);
                    }
                    $message = Session::get('message');
                    if($message){
                        echo '<div class="alert alert-success" style="text-align: center;font-size: 16px; font-weight: bold">'.$message.'</div>';
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
                    <form action="" method="post" name="myForm" onsubmit="return validateForm()">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" />
                        <input type="text" name="name" placeholder="Tên người dùng" id="id_name"/>
                        <input type="text" name="email" placeholder="Email" id="id_email" />
                        <input type="password" name="password" placeholder="Mật khẩu" id="id_password" />
                        <input type="password" name="password2" placeholder="Nhập lại mật khẩu"  />
                        <table>
                            <tr>
                                <td><input type="submit" id="btn_submit" class="btn btn-default" value="Đăng kí"style="color: white; background-color: #fe980f; border: solid; font-weight: bold;margin-top: 22px; padding-left: 30px; padding-right: 30px;"></input></td>
                                <td ><a id="hover_btn" href="page/dangnhap" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default">Đăng nhập</a></td>
                            </tr>
                        </table>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection




