@extends('admin.index')

@section('admin_content')
    <div class="table-agile-info">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Sửa thông tin admin
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<div class="alert alert-success" style="text-align: center">'.$message.'</div>';
                                Session::put('message',null);
                            }
                            $loi = Session::get('loi');
                            if($loi){
                                echo '<div class="alert alert-danger" style="text-align: center">'.$loi.'</div>';
                                Session::put('loi',null);
                            }
                            ?>
                            @if(count($errors)>0)
                                <div class="alert alert-danger" style="text-align: center">
                                    @foreach($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                                </div>
                            @endif

                            <form role="form" action="admin/edit/{{$admin_info->id}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label >Tên admin</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên admin" value="{{$admin_info->name}}">
                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$admin_info->email}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label >Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{$admin_info->phone}}">
                                </div>

                                <div class="form-group" >
                                    <label>Đổi mật khẩu : </label>
                                    <label class="radio-inline">
                                        <input name="ChangePass" value="0" checked
                                               type="radio" onchange="chon(this)"> Không
                                    </label>
                                    <label class="radio-inline">
                                        <input name="ChangePass" value="1"
                                               type="radio" onchange="chon(this)"> Có
                                    </label>
                                    <input type="password" name="password" class="form-control change_pass" disabled placeholder="Nhập mật khẩu cần đổi"/>
                                </div>
                                <div style="height: 20px"></div>
                                <button type="submit" class="btn btn-info">Sửa</button>
                                <a href="admin/info/{{$admin_info->id}}"><input type="button" class="btn btn-info" value="Hủy"></a>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function chon(obj)
        {
            var value = obj.value;
            if (value === '1'){
                $(".change_pass").removeAttr('disabled');
            }
            else {
                $(".change_pass").attr('disabled','');
            }
        }
    </script>
@endsection