<?php

namespace App\Http\Controllers;

use App\Comment;
use App\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getXoa($id, $idTinTuc){
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect('admin/tintuc/sua'.$idTinTuc)->with('thongbao', 'Xóa comment Thành Công');

    }

    public function postComment($id, Request $request){
        $idTinTuc = $id;
        $tintuc = TinTuc::find($id);
        $comment = new Comment();
        $comment->idTinTuc = $idTinTuc;
        if(Auth::check()){
            $comment->idUser = Auth::user()->id;
            $comment->NoiDung = $request->NoiDung;
        }
        else
        {
            $comment->idUser = 3;
            $comment->NoiDung = $request->NoiDung;
        }
        $comment->NoiDung = $request->NoiDung;
        $comment->save();

        return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.'."html")->with('thongbao','Bình luận thành công');

    }
}
