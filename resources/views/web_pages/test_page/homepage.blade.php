@extends('web_pages.layout')

@section('content')
<div class="features_items"><!--items-->
    <h2 class="title text-center">Danh sách các khóa học</h2>
    @if(!isset($khoahocbyid))
        <h2 class="title text-center">Có bai hoc kìa</h2>
    @endif
    @foreach($khoahoc as $kh)
        <div class="col-sm-4">
            <a href="#">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img style="height: 200px; margin-bottom: 20px" src="upload/khoahoc/{{$kh->HinhAnh}}" alt="" />
                            <h2>{{$kh->Ten}}</h2>
                            @if($kh->GiaKhoaHoc == 0)
                                <h4>{{'Miễn phí'}}</h4>
                            @else
                                <h4>{{'Giá : '.$kh->GiaKhoaHoc}}</h4>
                            @endif
                            <a href="https://www.facebook.com/" class="btn btn-default add-to-cart">Đăng kí</a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

</div><!--features_items-->

@endsection

