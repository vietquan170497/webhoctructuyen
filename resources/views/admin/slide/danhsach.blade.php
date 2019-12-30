@extends('admin.index')

@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách slide
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2" style="margin-bottom: 20px">
                <a href="admin/slide/them"><input type="button" class="btn btn-info col-sm-12" value="Thêm mới"></a>
            </div>
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if($message){
                echo '<div class="alert alert-success" style="text-align: center">'.$message.'</div>';
                Session::put('message',null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>link</th>
                        <th class="th_hanhdong">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($slides as $slide)
                    <tr>
                        <td>{{$slide->id}}</td>
                        <td>
                            <p>{{$slide->TieuDe}}</p>
                        </td>
                        <td>{{$slide->NoiDung}}</td>
                        <td>{{$slide->link}}</td>
                        <td style="width:100px;">
                            <a href="admin/slide/sua/{{$slide->id}}" class="active action-icon" ui-toggle-class="">
                                <i class="fa fa-pencil-alt text-success action_edit"  ></i>
                            </a>
                            <a onclick="return confirm('Bạn có xác nhận xóa!')" href="admin/slide/xoa/{{$slide->id}}" class="active action-icon" ui-toggle-class="">
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
                        {!! $slides->links() !!}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection