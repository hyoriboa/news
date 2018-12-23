@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Nội dung</th>
                        <th>Hình</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slide as $sd)
                        <tr class="odd gradeX" align="center">
                            <td>{{$sd->id}}</td>
                            <td>{{$sd->Ten}}</td>
                            <td>{{$sd->NoiDung}}</td>
                            <td>
                                <img width="350px" height="150px" src="upload/slide/{{$sd->Hinh}}" alt="">
                            </td>
                            <td>{{$sd->link}}</td>

                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <a href="admin/slide/xoa/{{$sd->id}}"> Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i>
                                <a href="admin/slide/sua/{{$sd->id}}">Sửa</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection