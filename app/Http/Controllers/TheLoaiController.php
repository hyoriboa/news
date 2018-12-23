<?php

namespace App\Http\Controllers;

use App\Http\Requests\TheLoaiRequest;
use App\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    //

    public function getDanhSach(){

        $theloai = TheLoai::all();

        return view('admin.theloai.danhsach', ['theloai'=>$theloai]);
//        return view('admin.theloai.danhsach',compact('theloai'));
    }

    public function getThem(){
        return view('admin.theloai.them');
    }
    public function postThem(TheLoaiRequest $request){

        $theloai = new TheLoai();
        $theloai->Ten = $request->txtCateName;
        $theloai->TenKhongDau = changeTitle($request->txtCateName);
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao', 'Thêm Thành Công');

    }


    public function getSua($id){
        $theloai = TheLoai::findOrFail($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(TheLoaiRequest $request, $id){
        $theloai = TheLoai::findOrFail($id);
//        $this->validate($request,
//            [
//                'txtCateName'       => 'required|unique:TheLoai,Ten|min:3|max:100'
//            ],
//            [
//                'txtCateName.requied'       => 'Bạn chưa nhập tên thể loại',
//                'txtCateName.unique'        => 'Tên thể loại đã tồn tại',
//                'txtCateName.min'       =>   'Tên thể loại phải từ 3-100 kí tự',
//                'txtCateName.max'       =>   'Tên thể loại phải từ 3-100 kí tự'
//            ]);
        $theloai->Ten = $request->txtCateName;
        $theloai->TenKhongDau = changeTitle($request->txtCateName);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Sửa Thành Công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }

}
