@extends('admin.index')

@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa bài học
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
                        $loi_video = Session::get('loi_video');
                        if($loi_video){
                            echo '<div class="alert alert-danger" style="text-align: center">'.$loi_video.'</div>';
                            Session::put('loi_video',null);
                        }
                        $size = Session::get('size');
                        if($size){
                            echo '<div class="alert alert-danger" style="text-align: center">'.$size.'</div>';
                            Session::put('size',null);
                        }
                        ?>
                        @if(count($errors)>0)
                            <div class="alert alert-danger" style="text-align: center">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @foreach($baihoc as $key=>$bh)
                            <form role="form" action="admin/baihoc/sua/{{$bh->id}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Loại khóa học</label>
                                    <select class="form-control m-bot15" name="LoaiKhoaHoc" id="LoaiKhoaHoc" onchange="changeLoai(this.value)">
                                        @foreach($khoahoc as $kh)
                                            @if($bh->idKhoaHoc == $kh->id)
                                                @foreach($loaikhoahoc as $lkh)
                                                    @if($kh->idLoaiKhoaHoc == $lkh->id)
                                                        <option value="{{$lkh->id}}" selected>{{$lkh->Ten}}</option>
                                                    @else
                                                        <option value="{{$lkh->id}}">{{$lkh->Ten}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Khóa học</label>
                                    <select class="form-control m-bot15" name="KhoaHoc" id="KhoaHoc">
                                        @foreach($khoahoc as $kh)
                                            @if($bh->idKhoaHoc == $kh->id)
                                                <option value="{{$kh->id}}" selected>{{$kh->Ten}}</option>
                                            @else
                                                <option value="{{$kh->id}}">{{$kh->Ten}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu đề bài học</label>
                                    <input type="text" name="TieuDe" class="form-control" id="" placeholder="Nhập tiêu đề bài học" value="{{$bh->TieuDe}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tóm tắt</label>
                                    <textarea name="TomTat" style="resize: none" rows="5" class="form-control ckeditor" id="" placeholder="Nhập tóm tắt">{{$bh->TomTat}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <textarea name="NoiDung" style="resize: none" rows="10" class="form-control ckeditor" id="" placeholder="Nhập nội dung bài học">{{$bh->NoiDung}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <p style="padding-left: 50px"><img width="200px" src="upload/baihoc/{{$bh->HinhAnh}}"></p>
                                    <input type="file" name="HinhAnh" class="" id="" placeholder="Chọn hình ảnh" value="{{$bh->HinhAnh}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Video</label><br>
                                    @if( $bh->Video != ""||$bh->Video != null)
                                        <p style="padding-left: 50px"><video style='height: 200px;' controls><source type='video/webm' src='upload/video/{{$bh->Video}}' alt='Video' ></video></p>
                                    @else
                                        <p style="padding-left: 50px; color: #ff9821; font-weight: bold; font-size: 18px">Không có video</p>
                                    @endif
                                    <input type="file" name="Video" class="" id="" placeholder="Chọn video" value="{{$bh->Video}}">
                                </div>
                                <div class="form-group">
                                    <label>Nổi bật : </label>
                                    <label class="radio-inline">
                                        <input name="NoiBat" value="0"
                                               @if($bh->NoiBat==0)
                                                    {{"checked"}}
                                               @endif
                                               type="radio"> Không
                                    </label>
                                    <label class="radio-inline">
                                        <input name="NoiBat" value="1"
                                               @if($bh->NoiBat==1)
                                               {{"checked"}}
                                               @endif type="radio">  Có
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Active</label>
                                    <select class="form-control m-bot15" name="TrangThai">
                                        <option value="0"
                                            @if($bh->TrangThai==0)
                                                {{"selected"}}
                                            @endif
                                        >Deactive
                                        </option>
                                        <option value="1"
                                            @if($bh->TrangThai==1)
                                                {{"selected"}}
                                            @endif
                                        >Active
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Sửa</button>
                                <a href="admin/baihoc/danhsach"><input type="button" class="btn btn-info" value="Hủy"></a>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>

<div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách các bình luận bài học
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
                        <th>Người dùng</th>
                        <th>Ngày tạo</th>
                        <th>Nội dung</th>
                        <th class="th_hanhdong">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($binhluan as $bl)
                        <tr>
                            <td>{{$bl->id}}</td>
                            <td>
                                @foreach($users as $user)
                                    @if($bl->idUser == $user->id)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$bl->created_at}}</td>
                            <td>{{$bl->NoiDung}}</td>
                            <td style="width:100px;">
                                <a onclick="return confirm('Bạn có xác nhận xóa!')" href="admin/binhluan/xoa/{{$bl->id}}" class="active action-icon action_delete" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text " ></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $("#LoaiKhoaHoc").change(function () {
                var idLoaiKhoaHoc = $(this).val();
                $.get("admin/ajax/khoahoc/"+idLoaiKhoaHoc, function (data) {
                    $('#KhoaHoc').html(data);
                });
                //alert(idLoaiKhoaHoc);
            });
        });
    </script>
@endsection