<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Anime;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnimeController extends Controller
{

    //Admin Add New Anime

    public function newAnime()
    {
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('admin.adminNewAnime', compact('genres'));
    }

    public function createAnime(Request $req)
    {
        $this->createValidator($req);
        $data = $this->createReturn($req);
        if ($req->hasFile('animeImage')) {
            $fileName = uniqid() . '_' . $req->animeTitle . '_' . $req->animeImage->getClientOriginalName();
            $req->file('animeImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Anime::create($data);
        return back()->with(['Message' => 'New anime added successfully']);
    }

    private function createValidator($req)
    {
        Validator::make($req->all(), [
            'animeTitle' => 'required',
            'animeImage' => 'mimes:jpg,jpeg,png',
            'animeYear' => 'required|numeric|min:2000|max:2023',
            'animeRating' => 'required|numeric|min:1|max:9',
            'animeEpisode' => 'required|numeric|min:1',
            'animeGenres' => 'required',
        ])->validate();
    }

    private function createReturn($req)
    {
        return [
            'title' => $req->animeTitle,
            'description' => $req->animeDes,
            'year' => $req->animeYear,
            'rating' => $req->animeRating,
            'episode_count' => $req->animeEpisode,
            'genre' => $req->animeGenres,
        ];
    }

    //User View Anime Details

    public function userAnimeDetails($id)
    {
        $userId = Auth::user()->id;
        $tabName = null;
        $anime = Anime::where('id', $id)->first();
        $oldViewCount = $anime->view_count;
        $data['view_count'] = $oldViewCount + 1;
        Anime::where('id', $id)->update($data);

        $genres = explode(',', $anime->genre);
        $recoms = Anime::where('genre', 'like', '%' . $genres[0] . '%')
            ->where('id', '!=', $anime->id)
            ->orderBy('id', 'desc')
            ->get();

        $episodes = Episode::where('anime_id', $id)
            ->orderBy('episode_number', 'asc')
            ->get();

        $status = "";
        if ($anime->available_episode == $anime->episode_count) {
            $status = "Completed";
        } else {
            $status = "On-going";
        }
        $animeNames = Bookmark::where('user_id', $userId)->first();
        if ($animeNames) {
            $animeNames = $animeNames->anime_name;
            $animeNames = explode(',', $animeNames);
        }
        return view('user.userAnimeDetails', compact('anime', 'status', 'tabName', 'animeNames', 'recoms', 'episodes'));
    }

    //User view Movie Details

    public function userMovieDetails($id)
    {
        $userId = Auth::user()->id;
        $tabName = null;
        $anime = Movie::where('id', $id)->first();
        $genres = explode(',', $anime->genre);
        $recoms = Movie::where('genre', 'like', '%' . $genres[0] . '%')
            ->where('id', '!=', $anime->id)
            ->orderBy('id', 'desc')
            ->get();
        $animeNames = Bookmark::where('user_id', $userId)->first();
        if ($animeNames) {
            $animeNames = $animeNames->anime_name;
            $animeNames = explode(',', $animeNames);
        }
        return view('user.userMovieDetails', compact('anime', 'tabName', 'animeNames', 'recoms'));
    }

    //User Watch Anime

    public function userAnimeWatch($id, $epid)
    {
        $user_id = Auth::user()->id;
        $anime = Anime::where('id', $id)->first();
        $comments = Comment::join('users', 'comments.user_id', 'users.id')
            ->select('comments.*', 'users.name')
            ->orderBy('comments.id', 'desc')
            ->get();
        // dd($comments->toArray());
        $tabName = null;
        $episodes = Episode::where('anime_id', $id)
            ->orderBy('episode_number', 'asc')
            ->get();
        return view('user.userWatch', compact('tabName', 'anime', 'id', 'epid', 'comments', 'episodes', 'user_id'));
    }

    //User Watch Movie

    public function userMovieWatch($id)
    {
        $user_id = Auth::user()->id;
        $anime = Movie::where('id', $id)->first();
        $comments = Comment::join('users', 'comments.user_id', 'users.id')
            ->select('comments.*', 'users.name')
            ->orderBy('comments.id', 'desc')
            ->get();
        $tabName = null;
        return view('user.userWatchMovie', compact('anime', 'comments', 'tabName', 'user_id'));
    }

    //User Delete Comment

    public function userCommentDelete($userId, $animeId, $epId)
    {
        Comment::where('user_id', $userId)
            ->where('anime_id', $animeId)
            ->where('episode_number', $epId)
            ->delete();
        return back();
    }

    //User Edit Comment

    public function userCommentEdit(Request $req, $userId, $animeId, $epId)
    {
        $data['description'] = $req->userComment;
        $data['updated_at'] = Carbon::now();
        Comment::where('user_id', $userId)
            ->where('anime_id', $animeId)
            ->where('episode_number', $epId)
            ->update($data);
        return back();
    }
}
