<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function home()
    {
        $data = Episode::join(DB::raw('(SELECT anime_id, MAX(episode_number) as latest_episode FROM episodes GROUP BY anime_id) latest_episodes'), function ($join) {
            $join->on('episodes.anime_id', '=', 'latest_episodes.anime_id')
                ->on('episodes.episode_number', '=', 'latest_episodes.latest_episode')
                ->join('animes', 'latest_episodes.anime_id', 'animes.id')
                ->select('episodes.*', 'animes.title');
        })->orderBy('episodes.id', 'desc')
            ->paginate(16);
        return response()->json($data, 200);
    }

    public function animelist()
    {
        $data = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('title', 'asc')->paginate(20);
        return response()->json($data, 200);
    }

    public function newseason()
    {
        $data = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('id', 'desc')->paginate(16);
        return response()->json($data, 200);
    }

    public function movies()
    {
        $data = Movie::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('id', 'desc')->paginate(16);
        return response()->json($data, 200);
    }

    public function popular()
    {
        $data = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('view_count', 'desc')->paginate(16);
        return response()->json($data, 200);
    }
}
