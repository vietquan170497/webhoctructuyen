@extends('admin.index')

@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách loại khóa học
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-10 ">
            </div>
            <div class="col-sm-2" style="margin-bottom: 20px">
                <a href="admin/loaikhoahoc/them"><input type="button" class="btn btn-info col-sm-12" value="Thêm mới"></a>
            </div>
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if($message){
                echo '<div class="alert alert-success">'.$message.'</div>';
                Session::put('message',null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên loại khóa học</th>
                        <th>Trạng thái</th>
                        <th class="th_hanhdong">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loaikhoahoc as $lkh)
                        <tr>
                            <td>{{$lkh->id}}</td>
                            <td>{{$lkh->Ten}}</td>
                            <td>
                                <span class="text-ellipsis">
                                    @if($lkh->TrangThai==0)
                                        <a href="admin/loaikhoahoc/deactive/{{$lkh->id}}"><button class="btn btn-info" style="width: 80px;">Ẩn</button></a>
                                    @else
                                        <a href="admin/loaikhoahoc/active/{{$lkh->id}}"><button class="btn btn-info" style="width: 80px;">Hiện</button></a>
                                    @endif
                                </span>
                            </td>
                            <td style="width:100px;">
                                <a href="admin/loaikhoahoc/sua/{{$lkh->id}}" class="active action-icon" ui-toggle-class="">
                                    <i class="fa fa-pencil-alt text-success action_edit"></i>
                                </a>
                                <a onclick="return confirm('Bạn có xác nhận xóa!')" href="admin/loaikhoahoc/xoa/{{$lkh->id}}" class="active action-icon" ui-toggle-class="">
                                    <i class="fa fa-times text-danger action_delete " ></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-3 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm"></small>
                </div>
                <div class="col-sm-9 text-right text-center-xs" style="float: right">
                    <ul class="pagination pagination-sm m-t-none m-b-none" style="float: right;padding-top: 50px">
                        {!! $loaikhoahoc->links() !!}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection