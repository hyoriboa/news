<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Slide;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //

    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);

//        if(Auth::check()){
//            view()->share('nguoidung',Auth::user());
//        }

    }

    function trangchu(){
        return view('pages.trangchu');
    }
    function lienhe(){
        return view('pages.lienhe');
    }
    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    function getDangnhap(){
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $request){
        $this->validate($request,
            [
                'email'           => 'required',
                'password'           => 'required|min:3|max:32',
            ],
            [
                'email.required'               => 'Bạn chưa nhập email người dùng',
                'password.required'         => 'Bạn chưa nhập mật khẩu',
                'password.min'       => 'Mật khẩu từ 3-32 kí tự',
                'password.max'       => 'Mật khẩu từ 3-32 kí tự',
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('trangchu');
        }else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập lại đi cậu');

        }
    }
    function getDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    public function getNguoiDung(){
        $user = Auth::user();
        return view('pages.nguoidung', ['nguoidung'=>$user]);
    }

    public function postNguoiDung(Request $request){
        $this->validate($request,
            [
                'name'           => 'required|min:3',
            ],
            [
                'name.required'           => 'Bạn chưa nhập tên người dùng',
                'name.min'          => 'Tên người dùng ít nhất 3 kí tự',
            ]);
        $user = Auth::user();
        $user->name = $request->name;

        if($request->changePassword == "on"){
            $this->validate($request,
                [
                    'password'           => 'required|min:3|max:32',
                    'passwordAgain'           => 'required|same:password',
                ],
                [
                    'password.required'         => 'Bạn chưa nhập mật khẩu',
                    'password.min'       => 'Mật khẩu từ 3-32 kí tự',
                    'password.max'       => 'Mật khẩu từ 3-32 kí tự',
                    'passwordAgain.required'       => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same'       => 'Mật khẩu nhập lại không khớp',
                ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('nguoidung')->with('thongbao', 'Sửa Thành Công');
    }

    public function getDangKy(){
        return view('pages.dangky');
    }
    public function postDangKy(UserRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        $user->save();

        return redirect('dangky')->with('thongbao', 'Tạo Tài Khoản Thành Công');
    }

    public function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like','%'.$tukhoa.'%')->orWhere('TomTat','like','%'.strtolower($tukhoa).'%')
            ->orWhere('TomTat','like','%'.strtoupper($tukhoa).'%')->orWhere('NoiDung','like','%'.strtolower($tukhoa).'%')
            ->orWhere('NoiDung','like','%'.strtolower($tukhoa).'%')->take(20)->paginate(5)->appends(['tukhoa'=>$tukhoa]);

        return view('pages.timkiem',['tukhoa'=>$tukhoa, 'tintuc'=>$tintuc]);
    }

}
