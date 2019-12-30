<div class="col-sm-3" style="">
    <div class="left-sidebar">
        <h2>Loại khóa học</h2>
        <div class="panel-group category-products" id="accordian">
            @foreach($loaikhoahoc as $lkh)
                <?php $i=0;?>
                @foreach($khoahoc as $kh)
                    @if($kh->idLoaiKhoaHoc == $lkh->id)
                        <?php $i = $i + 1;?>
                    @endif
                @endforeach
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordian" href="@if($i!=0) {{'#item'.$lkh->id}} @endif" style="color: #777777; font-size: 17px; {{--text-transform: uppercase;--}} font-weight: bold">
                            <span class="badge pull-right"><i class="@if($i!=0) {{'fa fa-plus'}} @endif"></i></span>
                            {{$lkh->Ten}}
                        </a>
                    </div>
                    <div id="{{'item'.$lkh->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($khoahoc as $kh)
                                    @if($kh->idLoaiKhoaHoc == $lkh->id)
                                        <li style="border: 1px solid #cccccc; border-radius: 5px ; padding: 5px; margin-top: 3px"><a style="font-size: 15px" href="page/dangkikhoahoc/{{$kh->id}}">{{$kh->Ten }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>