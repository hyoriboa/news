@extends('layout.index')
@section('content')

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->

                <p><span class="glyphicon glyphicon-time"></span> Posted on:{{$tintuc->created_at->diffForHumans()}}</p>
                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->

                <hr>

                <!-- Post Content -->
                <p class="lead">
                    {!! $tintuc->NoiDung !!}
                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif

                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$tintuc->id}}" method="post" role="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                {{--@if(Auth::guard()->check())--}}



                    {{--<hr>--}}
                {{--@else--}}
                    {{--<h4>Hãy đăng nhập để bình luận...<span class="glyphicon glyphicon-pencil"></span></h4>--}}
                    {{--<hr>--}}
                {{--@endif--}}

            <!-- Posted Comments -->

                @foreach($tintuc->comment as $cm)
                <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cm->user->name}}
                                <small>{{$cm->created_at->diffForHumans()}}</small>
                            </h4>
                            {{$cm->NoiDung}}
                        </div>
                    </div>
                @endforeach


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                    @foreach($tinlienquan as $tt)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <p>
                                        <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                            <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-7">
                                    <a href="#"><b>{{$tt->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left: 10px; padding-right: 5px">{{$tt->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                    @foreach($tinnoibat as $tt)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <p>
                                        <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                            <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-7">
                                    <a href="#"><b>{{$tt->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left: 10px; padding-right: 5px">{{$tt->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach


                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection