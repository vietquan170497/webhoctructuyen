<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Education</title>
    <base href="{{asset('')}}">
    <link href="web_style/css/bootstrap.min.css" rel="stylesheet">
    <link href="web_style/css/font-awesome.min.css" rel="stylesheet">
    <link href="web_style/css/prettyPhoto.css" rel="stylesheet">
    <link href="web_style/css/price-range.css" rel="stylesheet">
    <link href="web_style/css/animate.css" rel="stylesheet">
    <link href="web_style/css/main.css" rel="stylesheet">
    <link href="web_style/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="web_style/js/html5shiv.js"></script>
    <script src="web_style/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="web_style/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="web_style/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="web_style/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="web_style/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="web_style/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

@include('web_pages.layout.header')

@yield('content')

@include('web_pages.layout.footer')

<script src="web_style/js/jquery.js"></script>
<script src="web_style/js/bootstrap.min.js"></script>
<script src="web_style/js/jquery.scrollUp.min.js"></script>
<script src="web_style/js/price-range.js"></script>
<script src="web_style/js/jquery.prettyPhoto.js"></script>
<script src="web_style/js/main.js"></script>
@yield('script')
</body>
</html>