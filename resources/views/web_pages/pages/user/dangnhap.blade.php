@extends('web_pages.layout.index')
@section('content')
    <style>
        .ul_validate{
            padding-left:0px ;
            padding-bottom: 10px;
        }
        #hover_btn:hover{
            color: black;!important;
            background-color: green;
        }
    </style>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-5 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2 style="font-weight: bold">Đăng nhập tài khoản của bạn</h2>
                <div id="message" class="arlet arlet-danger" style="color: red">
                </div>
                <?php
                    $error_message = Session::get('error_message');
                    if($error_message){
                        echo '<div class="alert alert-danger" style="text-align: center;font-size: 16px; font-weight: bold">'.$error_message.'</div>';
                        Session::put('error_message',null);
                    }
                    $ss_dangnhap = Session::get('ss_dangnhap');
                    if($ss_dangnhap){
                        echo '<div class="alert alert-danger" style="text-align: center;font-size: 16px; font-weight: bold">' .$ss_dangnhap.'</div>';
                        Session::put('ss_dangnhap',null);
                    }
                    $dangxuat = Session::get('dangxuat');
                    if($dangxuat){
                        echo '<p class="alert alert-success" style="text-align: center;font-size: 16px; font-weight: bold">'.$dangxuat.'</p>';
                        Session::put('dangxuat',null);
                    }
                ?>
                @if(count($errors)>0)
                    <div class="alert alert-danger" style="text-align: center;font-size: 16px; font-weight: bold">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif
                <form action="page/dangnhap" method="post" name="myForm" onsubmit="return validateForm()">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="email" placeholder="Email" id="id_email"  />
                    <input type="password" name="password" placeholder="Mật khẩu" id="id_password" />
                    <table>
                        <tr>
                            <td><input type="submit" id="btn_submit" class="btn btn-default" value="Đăng nhập"style="color: white; background-color: #fe980f; border: solid; font-weight: bold;margin-top: 22px; padding-left: 30px; padding-right: 30px;"></input></td>
                            <td ><a id="hover_btn" href="page/dangki" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default">Đăng kí</a></td>
                        </tr>
                    </table>
                </form>
            </div><!--/login form-->
        </div>
    </div>
</div>

<div style="height: 50px;"></div>
@endsection





