<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>ducation</h2>
                        <p>Website đăng kí khóa học trực tuyến</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php $dem=0;?>
                    @foreach($khoahoc as $kh)
                        @if($dem<4)
                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="page/dangkikhoahoc/{{$kh->id}}">
                                        <div class="iframe-img">
                                            <img src="upload/khoahoc/{{$kh->HinhAnh}}" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                    <p>{{$kh->Ten}}</p>
                                </div>
                            </div>
                        @endif
                        <?php $dem++?>
                    @endforeach

                </div>
                <div class="col-sm-3 col-sm-offset-1" style="margin-top: 25px">
                    <div class="single-widget">
                        <h2>About</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2019 EDUCATION Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span style="color: #fe980f;font-size:17px;font-style: italic; text-decoration: underline ">VQn</span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->