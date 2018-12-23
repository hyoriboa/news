<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiTinRequest;
use App\LoaiTin;
use App\TheLoai;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    //

    public function getDanhSach(){

        $loaitin = LoaiTin::all();

        return view('admin.loaitin.danhsach', ['loaitin'=>$loaitin]);
//        return view('admin.LoaiTin.danhsach',compact('LoaiTin'));
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(LoaiTinRequest $request){

        $loaitin= new LoaiTin();
        $loaitin->Ten = $request->txtCateName;
        $loaitin->TenKhongDau = changeTitle($request->txtCateName);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao', 'Thêm Thành Công');

    }


    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::findOrFail($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(LoaiTinRequest $request, $id){
//        $this->validate($request,
//            [
//                'txtCateName'       => 'required|unique:LoaiTin,Ten|min:3|max:100',
//                'TheLoai'         =>'required',
//            ],
//            [
//                'txtCateName.requied'       => 'Bạn chưa nhập tên loại tin',
//                'txtCateName.unique'        => 'Tên loại tin đã tồn tại',
//                'txtCateName.min'           =>   'Tên loại tin  phải từ 3-100 kí tự',
//                'txtCateName.max'           =>   'Tên loại tin  phải từ 3-100 kí tự',
//                'TheLoai.requied'         =>   'Bạn chưa chọn thể loại',
//            ]);
        $loaitin = LoaiTin::findOrFail($id);
        $loaitin->Ten = $request->txtCateName;
        $loaitin->TenKhongDau = changeTitle($request->txtCateName);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Sửa Thành Công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }

}
