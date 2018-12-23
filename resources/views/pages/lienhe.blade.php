@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

        @include('layout.slide')


        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                        <div class="break"></div>
                        <h4><span class="glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>332/177/25, 1 Đường số 6, Phường 5, Gò Vấp, Hồ Chí Minh </p>


                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p> P. Tổng hợp: 028. 3836 7933 </p>
                        <p> P. Tuyển sinh: 028. 3837 4596 </p>


                        <br><br>


                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection