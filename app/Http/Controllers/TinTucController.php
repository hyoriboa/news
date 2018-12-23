<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiTinRequest;
use App\Http\Requests\TinTucRequest;
use App\Http\Requests\TinTucSuaRequest;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    //

    public function getDanhSach(){

//        $tintuc = TinTuc::orderBy('id','DESC')->get();
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach', ['tintuc'=>$tintuc]);
//        return view('admin.LoaiTin.danhsach',compact('LoaiTin'));
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(TinTucRequest $request){
        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi', 'Hình ảnh chỉ có định dạng JPG, PNG, JEPG');

            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm Thành Công');
    }


    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::findOrFail($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(TinTucSuaRequest $request, $id){
        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi', 'Hình ảnh chỉ có định dạng JPG, PNG, JEPG');

            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa Thành Công');

    }

    public function getXoa($id){
        $tintuc = TinTuc::findOrFail($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa Thành Công');

    }

}




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