<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    //User Add New Comment

    public function comment(Request $req, $userid, $animeid, $animeepid)
    {
        Validator::make($req->all(), [
            'userComment' => 'required',
        ])->validate();
        $data = $this->commentReturn($req, $userid, $animeid, $animeepid);
        Comment::create($data);
        return back();
    }

    private function commentReturn($req, $userid, $animeid, $animeepid)
    {
        return [
            'user_id' => $userid,
            'description' => $req->userComment,
            'anime_id' => $animeid,
            'episode_number' => $animeepid,
        ];
    }
}
