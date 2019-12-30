@extends('web_pages.layout.index')

@section('content')
    <!--content page-->
    <div class="container" style=" border-top: 1px solid #dddddd  ">
        <div class="row" style="margin-top: 50px; ">
            @include('web_pages.layout.menu')

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5 col-md-5">

                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                    <a href=""><img style="height: 250px; width: 100%" src="upload\khoahoc\{{$dangkikhoahoc->HinhAnh}}" alt=""></a>

                            </div>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <p style="color: #fe980f; font-size: 28px; font-weight: bold">{{$dangkikhoahoc->Ten}}</p>
                            <img src="images/product-details/rating.png" alt="" />
                            <span>
                                <p style="font-size: 20px; font-weight: bold; float: left; margin-top: 5px">
                                    @if($dangkikhoahoc->TraPhi==1)
                                        {{'Trả phí : &nbsp;'}}
                                        <p style="float: left;font-size: 25px; font-weight: bold; color: #1d3da7;  ">
                                        {{number_format($dangkikhoahoc->GiaKhoaHoc)}}
                                        </p>
                                    @else
                                    {{'Miễn phí  &nbsp;'}}
                                    @endif
                                </p>

                                <br>
                                <?php
                                    $user_id = Session::get('user_id');
                                ?>
                                <?php if($user_id):?>
                                    <a href="page/dangkikhoahoc/dangki/{{$dangkikhoahoc->id}}">
                                        <button type="button" class="btn btn-fefault cart" style="margin-top: 20px">
                                            <i class="fa fa-pencil-square-o" style="font-weight: bold"></i>
                                            Đăng kí
                                        </button>
                                    </a>
                                <?php else:
                                    Session::put('ss_dangnhap', 'Bạn chưa đăng nhập, mời đăng nhập!');
                                ?>
                                    <a href="page/dangnhap">
                                        <button type="button" class="btn btn-fefault cart" style="margin-top: 20px">
                                            <i class="fa fa-pencil-square-o" style="font-weight: bold"></i>
                                            Đăng kí
                                        </button>
                                    </a>
                                <?php endif;?>
								</span>
                            <p><b>Người đăng :</b> Admin</p>
                            <?php
                                if(isset($dangkikhoahoc->updated_at)){
                                    $newtime = strtotime($dangkikhoahoc->updated_at);
                                }
                                else {
                                    $newtime = strtotime($dangkikhoahoc->created_at);
                                }
                            ?>
                            <p><b>Ngày đăng :</b> {{$dangkikhoahoc->time = date('d - m - Y',$newtime)}}</p>
                            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12" >
                        <ul class="nav nav-tabs" style="background-color: #202020">
                            <li ><a href="#tomtat" data-toggle="tab">Tóm tắt</a></li>
                            <li class="active" ><a href="#reviews" data-toggle="tab">Bình luận</a></li>

                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tomtat" >
                            <div class="" style="padding: 20px" >
                                <div class="col-sm-12">
                                    <ul style="background-color: white; border: white">
                                        <li style="float: left; padding-left: 20px;"><i class="fa fa-user" style="padding-right: 5px"></i>Admin</li>
                                        <li style="float: left; padding-left: 20px;"><i class="fa fa-clock-o" style="padding-right: 5px"></i>{{$dangkikhoahoc->time = date('h : i',$newtime)}}</li>
                                        <li style="float: left; padding-left: 20px;"><i class="fa fa-calendar-o" style="padding-right: 5px"></i>{{$dangkikhoahoc->time = date('d - m - Y',$newtime)}}</li>
                                    </ul>
                                    <p style="margin: 50px 0 30px 20px">{!! $dangkikhoahoc->TomTat !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active in" id="reviews" style="border-top: #dddddd" >
                            <div class="" style="padding: 20px" >
                                <div class="col-sm-12" style="">
                                    @if(isset($binhluan))
                                        @if(count($binhluan)>0)
                                            @foreach($binhluan as $bl)

                                                <div class="col-sm-12" style="border-bottom: 1px solid #cccccc; margin-bottom: 35px; font-size: 16px">
                                                    <div class="row" style="padding: 0px 20px">
                                                        <p style="color: #fe980f"><b>Bài học : {{$bl->TieuDe}}</b></p>
                                                        <p style=""><b>{{$bl->name}} :</b> {{$bl->NoiDung}}</p>
                                                        <p style="float: right;font-size: 14px">  {{$bl->time = date('d - m - Y',strtotime($bl->updated_at))}}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div style="float: right">
                                                {{$binhluan->links()}}
                                            </div>
                                        @else
                                            <div class="col-sm-12" style=" margin-bottom: 50px">
                                                <div class="row" style="padding: 0px 20px">
                                                    <h4>Không có bình luận nào</h4>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
    <!--/content page-->

@endsection

