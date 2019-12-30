@extends('web_pages.layout.index')

@section('content')

@include('web_pages.layout.slide')

<!--content page-->
<div class="container" style=" border-top: 1px solid #aaaaaa ">
    <div class="row" style="margin-top: 50px; ">
        @include('web_pages.layout.menu')
        <div class="col-sm-9 padding-right">
            <!--khoahoc-->
            <div class="features_items">
                <h2 class="title text-center">Danh sách khóa học mới</h2>
                @if(isset($baihoc))
                    <h2 class="title text-center">Có bài học kìa</h2>
                @endif
                @foreach($khoahoc_home as $kh)
                    <a href="page/dangkikhoahoc/{{$kh->id}}"  >
                    <div class="col-sm-4" >
                        <div class="product-image-wrapper" style="border-radius: 15px; border: 1px solid #dddddd">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img style="height: 200px; margin-bottom: 20px;" src="upload/khoahoc/{{$kh->HinhAnh}}" alt="" />
                                    <h2 style="height: 80px;">
                                        <?php if(strlen($kh->Ten)>45){
                                            $str = substr($kh->Ten,0,42) . ' ... ' . substr($kh->Ten,strlen($kh->Ten)-3);
                                                echo $str;
                                            }else {
                                                echo $kh->Ten;
                                            }
                                        ?>
                                    </h2>
                                    @if($kh->GiaKhoaHoc == 0)
                                        <p style="font-size: 22px; font-weight: bold; color: #1d3da7; ">{{'Miễn phí'}}</p>
                                    @else
                                        <p style="font-size: 22px; font-weight: bold; color: #1d3da7; ">
                                            {{'Giá :&nbsp;'}}
                                            {{number_format($kh->GiaKhoaHoc)}}
                                        </p>
                                    @endif
                                </div>

                            <img src="web_style/images/home/new.png" class="new" alt="" />
                            </div>
                            <div style="height: 20px"></div>
                        </div>
                    </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--/content page-->
<div class="container" style=" border-top: 1px solid #aaaaaa; margin-top: 20px;">
    <div class="row" style="margin-top: 20px; ">
        <p class="title text-center" style="margin-top: 50px; margin-bottom: 40px; font-size: 20px; text-transform: uppercase; font-weight: bold; color: #fe980f">Bài học nổi bật</p>
        @if(!isset($baihoc_noibat))
            <h4 class="" style="color:#fe980f; text-align: center">Không có bài học nổi bật</h4>
        @else
            @foreach($baihoc_noibat as $bh)
                <div class="col-sm-3">
                    <div class="product-image-wrapper" style="border-radius: 15px; border: 1px solid #dddddd">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img style="height: 150px; margin-bottom: 20px" src="upload/baihoc/{{$bh->HinhAnh}}" alt="" />
                                <div style="height: 90px">
                                    <h2 style="height: 50px;">
                                        <?php
                                            if(strlen($bh->TieuDe)>45){
                                                $str = substr($bh->TieuDe,0,40) . ' ... ' . substr($bh->TieuDe,strlen($bh->TieuDe)-3);
                                                echo $str;
                                            }else {
                                                echo $bh->TieuDe;
                                            }
                                        ?>
                                    </h2>
                                </div>
                                <a href="page/baihoc/{{$bh->id}}" class="btn btn-default add-to-cart">Xem bài học</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="pagination-area" style="float: right" style="margin-bottom: 0px">
        <ul class="pagination pagination-sm m-t-none m-b-none" style="margin-bottom: 0px; padding-bottom: 0px">
            {!! $baihoc_noibat->links() !!}
        </ul>
    </div>
</div>

@endsection



