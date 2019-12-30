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
                    <h2 style="font-weight: bold">Xác nhận xóa khóa học</h2>

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
                    <form action="page/xoakhoahoc/{{$dk_khoahoc->id}}" method="post" name="myForm" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người dùng</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" placeholder="Nhâp tên người dùng" name="name" disabled value="{{$dk_khoahoc->name}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Khóa học</label>
                            <input type="text" style="font-weight: bold; color: #888888; font-size: 18px; padding-left: 20px" name="email" disabled value="{{$dk_khoahoc->Ten}}" />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu (<p style="display: inherit; color: red">*</p>)</label>
                            <input type="password" class="password" style="font-weight: bold; color: #000000; font-size: 18px; padding-left: 20px;" name="matkhaucu" value="" placeholder="Nhâp mật khẩu cũ" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nhập lại mật khẩu (<p style="display: inherit; color: red">*</p>)</label>
                            <input type="password" class="password" style="font-weight: bold; color: #000000; font-size: 18px; padding-left: 20px" name="matkhaucu2" placeholder="Nhập lại mật khẩu mới" />
                        </div>
                        <table>
                            <tr>
                                <td ><input type="submit" id="btn_submit" class="btn btn-default " value="Xóa khóa học"style="color: white; background-color: #fe980f; border: solid; font-weight: bold;margin-top: 22px; padding-left: 30px; padding-right: 30px;"></input></td>
                                <td ><a href="page/khoahoc_user" style="color: white; background-color: #fe980f; border: solid; margin-top: 12px; padding-top: 8px;font-weight: bold; padding-left: 30px; padding-right: 30px; height: 40px" class="btn btn-default btn_hover">Hủy</a></td>
                            </tr>
                        </table>
                    </form>

                </div><!--/login form-->
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection




