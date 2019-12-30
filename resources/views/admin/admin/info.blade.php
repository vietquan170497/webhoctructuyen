@extends('admin.index')

@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin admin
            </div>
            <?php
                $message = Session::get('message');
                if($message){
                    echo '<div class="alert alert-success" style="text-align: center">'.$message.'</div>';
                    Session::put('message',null);
                }
            ?>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên admin</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$admin_info->id}}</td>
                            <td>
                                <p>{{$admin_info->name}}</p>
                            </td>
                            <td>{{$admin_info->email}}</td>
                            <td>{{$admin_info->phone}}</td>
                            <td><a href="admin/edit/{{$admin_info->id}}"><button class="btn btn-info" style="width: 130px;">Sửa tài khoản</button></a></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection