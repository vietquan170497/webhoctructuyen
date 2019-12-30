@extends('web_pages/layout/index')

@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="title text-center"><strong>liên hệ với chúng tôi</strong></h2>
                <div id="gmap" class="contact-map">
                    <div class="col-sm-12 bg-info" style=" height: 300px">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7334694906776!2d105.
                        84113201445419!3d21.003318494023326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
                        1!3m3!1m2!1s0x3135ac773026b415%3A0x499b8b613889f78a!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYy
                        BYw6J5IEThu7FuZw!5e0!3m2!1svi!2s!4v1574845917977!5m2!1svi!2s" width="100%" height="400"
                                frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>

            <div class="col-sm-4" style="margin-top: 5px">
                <div class="contact-info">
                    <h2 class="title text-center">thông tin liên hệ</h2>
                    <address>
                        <p>- EDUCATION.</p>
                        <p>- Số 55 đường Giải Phóng, p.Đồng Tâm, q.Hai Bà Trưng, TP Hà Nội.</p>
                        <p>- Mobile: +84 123 456 789.</p>
                        <p>- Email: education@gmail.com.</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Mạng xã hội</h2>
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->
@endsection

