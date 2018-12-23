<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeUserRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem(){
        return view('admin.user.them');

    }
    public function postThem(UserRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao', 'Thêm Thành Công');

    }


    public function getSua($id){
        $user = User::findOrFail($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(ChangeUserRequest $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;

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

        return redirect('admin/user/sua/'.$id)->with('thongbao', 'Sửa Thành Công');

    }

    public function getXoa($id){
        $user = User::findOrFail($id)->delete();
        return redirect('admin/user/danhsach')->with('thongbao', 'Xóa USer Thành Công');

    }

    public function dangnhapAdmin(){
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
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
            return redirect('admin/theloai/danhsach');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập lại đi cậu');
        }
    }

    public function getDangXuatpAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');

    }
}
