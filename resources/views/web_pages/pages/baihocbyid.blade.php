@extends('web_pages.layout.index')

@section('content')
    <style>
        .div_baihoc{
            padding: 0px 0px;
        }
        .div_baihoc .color_h4{
            color: #fea125;
        }
    </style>
    <div class="container">
        <div class="row">
            @include('web_pages.layout.menu')

            <div class="col-sm-9 padding-right">

                <div class="category-tab shop-details-tab"><!--category-tab-->

                    <div class="tab-content">
                        @if(!isset($baihocbyid))
                            <h2 class="title text-center" style="margin-top: 20px">Nội dung bài học</h2>
                            <h4 class="" style="color:#fe980f; text-align: center">Không có bài học</h4>
                        @else
                            <h2 class="title text-center" style="margin-top: 20px">Nội dung bài học - {{$baihocbyid->TieuDe}}</h2>
                            <?php
                                if(isset($baihocbyid->updated_at)){
                                    $newtime = strtotime($baihocbyid->updated_at);
                                }
                                else {
                                    $newtime = strtotime($baihocbyid->created_at);
                                }
                            ?>
                            <div class="tab-pane fade active in" id="reviews" >
                                <div class="col-sm-12">
                                    <ul>
                                        <li><a ><i class="fa fa-calendar-o"></i>{{$baihocbyid->time = date('d - m - Y',$newtime)}}</a></li>
                                        <li><a ><i class="fa fa-clock-o"></i>{{$baihocbyid->time = date('H:i',$newtime)}}</a></li>
                                    </ul>
                                    <div class="div_baihoc">
                                        <h4 class="color_h4" > - Tóm tắt</h4>
                                        <div style="margin-left: 30px; padding-top: 0px">
                                            <p>&emsp;&emsp;{!! $baihocbyid->TomTat !!}</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 30px">
                                        <div class="col-sm-2"></div>
                                        @if( $baihocbyid->Video != ""||$baihocbyid->Video != null)
                                            <video style="height: 300px; " controls><source type="video/webm" src="upload/video/{{$baihocbyid->Video}}" alt="Video" ></video>
                                        @else
                                            <img src="upload/images/no_video.png" style="height: 300px">
                                        @endif
                                    </div>
                                    <div class="div_baihoc">
                                        <h4 class="color_h4"> - Nội dung</h4>
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-1"></div>--}}
                                            <div style="margin-left: 30px">
                                                <p>{!! $baihocbyid->NoiDung !!}</p>
                                            </div>
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div><!--/category-tab-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" style="background-color: #202020">
                            <li class="active" ><a href="#reviews" data-toggle="tab">Bình luận</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>

                    <?php
                    $error_message = Session::get('error_message');
                    if($error_message){
                        echo '<div class="alert alert-danger" style="text-align: center; font-size: 18px; font-weight: bold">'.$error_message.'</div>';
                        Session::put('error_message',null);
                    }
                    $message = Session::get('message');
                    if($message){
                        echo '<div class="alert alert-success" style="text-align: center; font-size: 18px; font-weight: bold">'.$message.'</div>';
                        Session::put('message',null);
                    }
                    ?>
                    @if(count($errors)>0)
                        <div class="alert alert-danger" style="text-align: center;font-size: 18px; font-weight: bold">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="clearfix"></div>

                    <div class="tab-content">
                        <div class="" style="padding: 20px" >
                            <div class="col-sm-12" style="">
                                @if(isset($binhluan))
                                    @if(count($binhluan)>0)
                                        @foreach($binhluan as $bl)
                                            <div class="col-sm-12" style="border-bottom: 1px solid #cccccc; margin-bottom: 35px; font-size: 16px">
                                                <div class="row" style="padding: 0px 20px">
                                                    <p style="color: black"><b style="color: #3578E5"> {{$bl->name}}:</b> <b>{{$bl->NoiDung}}</b></p>
                                                    <p style="float: right;font-size: 14px">  {{$bl->time = date('d - m - Y',strtotime($bl->updated_at))}}</p>
                                                </div>
                                                <?php $user_name = Session::get('user_name');?>
                                                <?php if($user_name && $user_name == $bl->name):?>
                                                    <div style='font-weight: bold; font-size: 15px '>Sửa bình luận</div>
                                                    <div style="height: 02px" class="clearfix"></div>
                                                    <div  class='clearfix ' >
                                                        <form action='page/suabinhluan/{{$bl->id}}' method='post'>
                                                            {{ csrf_field() }}
                                                            <textarea name='sua_binhluan' rows='2'>{{$bl->NoiDung}}</textarea>
                                                            <div class="col-sm-1">
                                                                <button type='submit' class='btn btn-primary ' class="sua_bl">Sửa</button>
                                                            </div>
                                                        </form>
                                                            <div class="col-sm-1" >
                                                                <a onclick="return confirm('Bạn có xác nhận xóa!')" href="page/xoabinhluan/{{$bl->id}}">
                                                                    <button type='button' class='btn btn-primary'>Xóa</button>
                                                                </a>
                                                            </div>
                                                    </div>
                                                <?php endif;?>
                                                <div style="height: 20px"></div>
                                            </div>
                                        @endforeach
                                            <div  style="float: right;">
                                                    {!! $binhluan->links() !!}
                                            </div>
                                    @else
                                        <div class="col-sm-12" style=" margin-bottom: 50px">
                                            <div class="row" style="padding: 0px 20px">
                                                <h4>Không có bình luận nào</h4>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <?php $user_id = Session::get('user_id');?>
                                    @if(isset($user_id))
                                        <div style='font-weight: bold; font-size: 15px '>Viết bình luận</div>
                                            <form action='page/thembinhluan/{{$idBaiHoc}}' method='post'>
                                                {{ csrf_field() }}
                                                <textarea name='them_binhluan' rows='5'></textarea>
                                                <button type='submit' class='btn btn-primary '>
                                                    Thêm
                                                </button>
                                            </form>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style=" border-top: 1px solid #aaaaaa; margin-top: 20px;">
        <div class="row" style="margin-top: 20px; ">
            <p class="title text-center" style="margin-top: 50px; margin-bottom: 40px; font-size: 20px; text-transform: uppercase; font-weight: bold; color: #fe980f">Bài học liên quan</p>
            @if(!isset($baihoc_lienquan))
                <h4 class="" style="color:#fe980f; text-align: center">Không có bài học liên quan</h4>
            @else
                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($baihoc_lienquan as $bh)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper" style="border-radius: 15px; border: 1px solid #dddddd">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="height: 150px; margin-bottom: 20px" src="upload/baihoc/{{$bh->HinhAnh}}" alt="" />
                                                <div style="height: 70px">
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
                        </div>

                    </div>

                </div>
                <div class="pagination-area" style="float: right">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!! $baihoc_lienquan->links() !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection

