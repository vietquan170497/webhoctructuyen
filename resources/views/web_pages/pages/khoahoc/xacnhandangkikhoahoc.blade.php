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
        .btn_hover:hover{
            color: black;!important;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2 style="font-weight: bold">Xác nhận thông tin đăng kí khóa học</h2>
                    <div id="message" class="arlet arlet-danger" style="color: red">
                    </div>
                    <?php
                    $error_message = Session::get('error_message');
                    if($error_message){
                        echo '<div class="alert alert-danger" style="text-align: center; font-size: 16px; font-weight: bold">'.$error_message.'</div>';
                        Session::put('error_message',null);
                        //$error_message = null;
                    }
                    $message = Session::get('message');
                    if($message){
                        echo '<div class="alert alert-success" style="text-align: center; font-size: 16px; font-weight: bold">'.$message.'</div>';
                        Session::put('message',null);
                    }
//                    $ss_dangnhap = Session::get('ss_dangnhap');
//                    if($ss_dangnhap){
//                        echo '<p style="text-align: left; color:#fe980f;margin-bottom:20px;font-size: 18px">' .$ss_dangnhap.'</p>';
//                        Session::put('ss_dangnhap',null);
//                    }


                    ?>
                    <form action="page/dangkikhoahoc/dangki/{{$khoahocdangki->id}}" method="post" name="myForm" onsubmit="return validateForm()">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người dùng</label>
                            <input type="text" style="font-weight: bold; color: black; font-size: 18px" name="email" disabled value="{{$user_name}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khóa học</label>
                            <input type="text" style="font-weight: bold; color: black; font-size: 18px" name="email"  disabled value="{{$khoahocdangki->Ten}}" />
                        </div>
                        @if(!$khoahocdangki->TraPhi == 1)
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size: 18px; color: #fe980f">Khóa học miễn phí</label>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá khóa học</label>
                                <input type="text" style="font-weight: bold; color: black; font-size: 18px" name="email"  disabled value="{{$khoahocdangki->GiaKhoaHoc}}" />
                            </div>
                        @endif
                        <table>
                            <tr>
                                <td class="btn_hover"><input type="submit" id="btn_submit" class="btn btn-default " value="Đăng kí"style="color: white; background-color: #fe980f; border: solid; font-weight: bold;margin-top: 22px; padding-left: 30px; padding-right: 30px;"></input></td>
                                <td ><a href="page/dangkikhoahoc/{{$khoahocdangki->id}}" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default btn_hover">Hủy</a></td>
                            </tr>
                        </table>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection





