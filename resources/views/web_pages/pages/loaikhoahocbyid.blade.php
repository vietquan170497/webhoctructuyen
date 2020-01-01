@extends('web_pages.layout.index')

@section('content')

    @include('web_pages.layout.slide')

    <!--content page-->
    <div class="container" style=" border-top: 1px solid #aaaaaa ">
        <div class="row" style="margin-top: 50px; ">
            @include('web_pages.layout.menu')

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--items-->
                    <h2 class="title text-center">Danh sách các khóa học loại - {{$loaikhoahocTen->Ten}}</h2>
                    @if (count($loaikhoahocbyid)==0)
                    <h4 class="" style="color:#fe980f; text-align: center">Không có khóa học nào trong loại khóa học</h4>
                    @endif
                    @foreach($loaikhoahocbyid as $kh)
                        <a href="page/dangkikhoahoc/{{$kh->id}}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper" style="border-radius: 15px; border: 1px solid #dddddd">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img style="height: 200px; margin-bottom: 20px" src="upload/khoahoc/{{$kh->HinhAnh}}" alt="" />
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
                                    </div>
                                    <div style="height: 20px"></div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div><!--features_items-->
                <div class="pagination-area" style="float: right">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!! $loaikhoahocbyid->links() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/content page-->

@endsection
