<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anime;
use App\Models\Movie;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentHomeController extends Controller
{
    //Admin Comment Homepage

    public function adminCommentHome()
    {

        $comments = Comment::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'comments.user_id', 'users.id')
            ->join('animes', 'comments.anime_id', 'animes.id')
            ->select('comments.*', 'users.name', '.animes.title')
            ->orderBy('id', 'desc')
            ->paginate(20);
        $comments->appends(request()->all());
        $tabName = "comment";
        foreach ($comments as $comment) {
            if ($comment->episode_number == 0) {
                $comment->title =  Movie::where('id', $comment->anime_id)->first()->title;
            }
        }
        return view('admin.adminCommentHomepage', compact('comments', 'tabName'));
    }

    //Sortings

    public function commentsidsort()
    {
        $comments = Comment::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'comments.user_id', 'users.id')
            ->join('animes', 'comments.anime_id', 'animes.id')
            ->select('comments.*', 'users.name', '.animes.title')
            ->orderBy('id', 'asc')
            ->paginate(10);
        $comments->appends(request()->all());
        $tabName = "comment";
        return view('admin.adminCommentHomepage', compact('comments', 'tabName'));
    }

    public function commentsusernamesort()
    {
        $comments = Comment::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'comments.user_id', 'users.id')
            ->join('animes', 'comments.anime_id', 'animes.id')
            ->select('comments.*', 'users.name', '.animes.title')
            ->orderBy('users.name', 'asc')
            ->paginate(10);
        $comments->appends(request()->all());
        $tabName = "comment";
        return view('admin.adminCommentHomepage', compact('comments', 'tabName'));
    }

    public function commentsanimenamesort()
    {
        $comments = Comment::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'comments.user_id', 'users.id')
            ->join('animes', 'comments.anime_id', 'animes.id')
            ->select('comments.*', 'users.name', '.animes.title')
            ->orderBy('animes.title', 'asc')
            ->paginate(10);
        $comments->appends(request()->all());
        $tabName = "comment";
        return view('admin.adminCommentHomepage', compact('comments', 'tabName'));
    }

    //Admin View Comment

    public function commentsview($id)
    {
        $comment = Comment::where('id', $id)->first();
        if ($comment->episode_number == 0) {
            $name = Movie::where('id', $comment->anime_id)->first();
        } else {
            $name = Anime::where('id', $comment->anime_id)->first();
        }
        $userName = $comment->user_id;
        $userName = User::where('id', $userName)->first();
        $userName = $userName->name;

        return view('admin.adminCommentDetails', compact('comment', 'name', 'userName'));
    }

    //Admin Delete Comment

    public function commentsdelete($id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->route('admin#comment#home')->with(['Message' => 'Comment deleted successfully']);
    }
}
