@extends('web_pages.layout.index')
@section('content')
    <style>
        ::placeholder {
            color: #888888;
            font-weight: normal;
            opacity: 1; /* Firefox */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2 style="font-weight: bold">Nạp tiền vào tài khoản người dùng</h2>
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
                    <form action="page/naptien" method="post" name="myForm" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người dùng</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" placeholder="Nhập tên người dùng" name="name" disabled value="{{$nguoidung->name}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" name="email" disabled value="{{$nguoidung->email}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài khoản</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" name="TaiKhoan"  disabled value="{{$nguoidung->TaiKhoan}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ nạp - Số tiền nạp (<p style="display: inherit; color: red">*</p>)</label>
                            <input type="text" style="font-weight: bold; color: #000000; font-size: 18px; padding-left: 20px;" name="sotien" value="" placeholder="Nhâp thẻ nạp - Số tiền nạp" />
                        </div>
                        <table>
                            <tr>
                                <td ><input type="submit" id="btn_submit" class="btn btn-default " value="Nạp tiền"style="color: white; background-color: #fe980f; border: solid; font-weight: bold;margin-top: 22px; padding-left: 30px; padding-right: 30px;"></input></td>
                                <td ><a href="page/taikhoan" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default btn_hover">Hủy</a></td>
                            </tr>
                        </table>
                    </form>

                </div><!--/login form-->
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection



