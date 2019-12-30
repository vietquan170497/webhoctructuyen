<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
    <title>Trang quản trị Admin</title>
    <base href="{{asset('')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="admin_style/css/bootstrap.min.css" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="admin_style/css/style.css" rel='stylesheet' type='text/css' />
    <link href="admin_style/css/style-responsive.css" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="admin_style/css/font.css" type="text/css"/>
    <link href="admin_style/css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="admin_style/js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
    <div class="w3layouts-main">
        <h2>Đăng nhập hệ thống</h2>
        <?php
            $message = Session::get('message');
            if($message){
                echo '<div class="alert alert-danger">'.$message.'</div>';
                Session::put('message',null);
            }
        ?>
{{--        @if(session('message'))--}}
{{--            <div class="alert alert-danger">--}}
{{--                {{session('thongbao')}}--}}
{{--            </div>--}}
{{--            Session::put('message',null);--}}
{{--        @endif--}}
        <form action="admin/dashboard" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="email" class="ggg" name="email" placeholder="USERNAME" required="">
            <input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
{{--            <span><input type="checkbox" />Nhớ tài khoản</span>--}}
{{--            <h6><a href="#">Quên mật khẩu?</a></h6>--}}
            <div class="clearfix"></div>
            <input type="submit" value="Đăng nhập" name="login">
        </form>
{{--        <p>Bạn chưa có tài khoản ?<a href="registration.html">Tạo một tài khoản</a></p>--}}
    </div>
</div>
<script src="admin_style/js/bootstrap.js"></script>
<script src="admin_style/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="admin_style/js/scripts.js"></script>
<script src="admin_style/js/jquery.slimscroll.js"></script>
<script src="admin_style/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="admin_style/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="admin_style/js/jquery.scrollTo.js"></script>
</body>
</html>
