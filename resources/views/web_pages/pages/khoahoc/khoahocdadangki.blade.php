@extends('web_pages.layout.index')

@section('content')

    @include('web_pages.layout.slide')

    <!--content page-->
    <div class="container" style=" border-top: 1px solid #aaaaaa ">
        <div class="row" style="margin-top: 50px; ">
            @include('web_pages.layout.menu')

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--items-->
                    @if(count($dangkikhoahoc)==0)
                        <h3 style="color: #fe980f" class="title text-center">Người dùng chưa đăng kí khóa học nào</h3>
                    @else
                        <h2 class="title text-center">Danh sách các khóa học đã đăng kí</h2>
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
                        @foreach($dangkikhoahoc as $kh)
                            <a href="page/khoahoc/{{$kh->idKhoaHoc}}">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper" style="border-radius: 15px; border: 1px solid #dddddd">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="height: 200px; margin-bottom: 20px" src="upload/khoahoc/{{$kh->HinhAnh}}" alt="" />
                                                <h2 style="height: 55px;">
                                                    <?php if(strlen($kh->Ten)>35){
                                                        $str = substr($kh->Ten,0,30) . ' ... ' . substr($kh->Ten,strlen($kh->Ten)-3);
                                                        echo $str;
                                                    }else {
                                                        echo $kh->Ten;
                                                    }
                                                    ?>
                                                </h2>
                                                @if($kh->GiaKhoaHoc == 0)
                                                    <h4>{{'Miễn phí'}}</h4>
                                                @else
                                                    <h4>{{'Giá : '.$kh->GiaKhoaHoc}}</h4>
                                                @endif
                                                <a style="margin-top: 20px" href="page/khoahoc/{{$kh->idKhoaHoc}}" class="btn btn-default add-to-cart">Xem khóa học</a>
                                                <a style="margin-top: 20px" href="page/xoakhoahoc/{{$kh->idDKKH}}" class="btn btn-default add-to-cart">Xóa khóa học</a>
                                            </div>
                                        </div>
                                        <div style="height: 5px"></div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div><!--features_items-->
                <div class="pagination-area" style="float: right">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!! $dangkikhoahoc->links() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/content page-->

@endsection