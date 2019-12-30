@extends('web_pages.layout.index')

@section('content')

    @include('web_pages.layout.slide')

    <!--content page-->
    <div class="container" style=" border-top: 1px solid #aaaaaa ">
        <div class="row" style="margin-top: 50px; ">
            @include('web_pages.layout.menu')

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--items-->
                    @foreach($khoahoc as $kh)
                        @if($kh->id == $id)
                            <h2 class="title text-center">Danh sách các bài học - {{$kh->Ten}}</h2>
                        @endif
                    @endforeach
                    @if(!isset($baihoc) )
                        <h2 class=" ">Không có biến bài học </h2>
                    @elseif (count($baihoc)==0)
                        <h4 class="" style="color:#fe980f; text-align: center">Không có bài học nào trong khóa học</h4>
                    @else
                        @foreach($baihoc as $bh)
                            <div class="col-sm-4">
                                <a>
                                    <div class="product-image-wrapper" style="border-radius: 15px; border: 1px solid #dddddd">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="height: 150px; margin-bottom: 20px" src="upload/baihoc/{{$bh->HinhAnh}}" alt="" />
                                                <div style="height: 80px">
                                                    <h2 style="height: 55px;">
                                                        <?php if(strlen($bh->TieuDe)>45){
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
                                </a>
                            </div>
                        @endforeach
                    @endif

                </div><!--features_items-->
                <div class="pagination-area" style="float: right">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!! $baihoc->links() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/content page-->

@endsection