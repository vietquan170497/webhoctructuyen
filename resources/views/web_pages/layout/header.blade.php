<header id="header" ><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a ><i class="fa fa-phone"></i> +84 123 456 789</a></li>
                            <li><a ><i class="fa fa-envelope"></i> education@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="page/home"><img src="web_style/images/home/logopage.png" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
{{--                            <li><a href="#"><i class="fa fa-pencil-square" style="font-size: 18px"></i> Khóa học đã đăng kí</a></li>--}}
{{--                            <li><a href="#"><i class="fa fa-user" style="font-size: 18px"></i> Tài khoản</a></li>--}}
                            <?php
                                $user_id = Session::get('user_id');
                                if(isset($user_id)){
                                    echo '<li><a href="page/khoahoc_user"><i class="fa fa-pencil-square" style="font-size: 18px"></i> Khóa học đã đăng kí</a></li>';
                                }
                            ?>

                            <?php
                                $user_name = Session::get('user_name');
                                if(isset($user_name)){
                                    echo "<li><a href='page/taikhoan'><i class=\"fa fa-user\" style=\"font-size: 18px\"></i> ".$user_name."</a></li>";
                                }
                            ?>
                            <?php
                                $user_id = Session::get('user_id');
                                if(isset($user_id)){
                                    echo "<li><a href='page/dangxuat'><i class=\"fa fa-lock\" style=\"font-size: 18px\"></i> Đăng xuất</a></li>";
                                }else{
                                    echo "<li><a href='page/dangnhap'><i class=\"fa fa-lock\" style=\"font-size: 18px\"></i> Đăng nhập</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="page/home" class="active">Home</a></li>
                            <li class="dropdown"><a>Các loại khóa học<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($loaikhoahoc as $lkh)
                                        <li><a href="page/loaikhoahoc/{{$lkh->id}}">{{$lkh->Ten}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="page/khoahoc">Các khóa học</a></li>
                            <li><a href="page/lienhe">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">

                    <form action="page/timkiem" method="get" class="navbar-form navbar-left" role="search">
{{--                        <input type="hidden" name="_token" value={{csrf_token()}}>--}}
                        <div class="row">
                            <div class="col-sm-10" style="padding-right: 0px">
                            <input type="text" class="form-control" name="tukhoa" placeholder="Tìm kiếm khóa học">
                            </div>
                            <div class="col-sm-2" style="padding-left: 0px">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->