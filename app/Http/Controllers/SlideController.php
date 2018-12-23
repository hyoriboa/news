<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlideRequest;
use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //

    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach', ['slide'=>$slide]);
    }

    public function getThem(){
        return view('admin.slide.them');
    }
    public function postThem(SlideRequest $request){
        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/them')->with('loi', 'Hình ảnh chỉ có định dạng JPG, PNG, JEPG');

            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }else{
            $slide->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao', 'Thêm Thành Công');
    }


    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(SlideRequest $request, $id){
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/them')->with('loi', 'Hình ảnh chỉ có định dạng JPG, PNG, JEPG');

            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide",$Hinh);

            $slide->Hinh = $Hinh;
        }

        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao', 'Sửa Thành Công');
    }

    public function getXoa($id){
        $slide = Slide::find($id)->delete();
        return redirect('admin/slide/danhsach')->with('thongbao', 'Xóa Thành Công');

    }

}
