<!--slider-->
<div class="container" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $i=0;?>
                    @foreach($slide as $sl)
                        <li data-target="#slider-carousel" data-slide-to="{{$i}}" class="
                        @if($i==0)
                                {{"active"}}
                        @endif
                        "></li>
                            <?php $i++?>
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    <?php $i=0;?>
                    @foreach($slide as $sl)
                        <div class="item
                        @if($i==0)
                            {{"active"}}
                        @endif">
                            <div class="col-sm-4" style="margin-top: 40px">
                                <h2>{{$sl->TieuDe}}</h2>
                                <p>{{$sl->NoiDung}}. </p>
                                 </div>
                            <div class="col-sm-8">
                                <img style="height: 250px; width: 100%" src="upload/slide/{{$sl->HinhAnh}}" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        <?php $i++;?>
                    @endforeach

                </div>
                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </div>
    </div>
</div>
<!--/slider-->
