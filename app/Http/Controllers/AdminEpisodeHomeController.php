<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class AdminEpisodeHomeController extends Controller
{
    //Admin Episode Homepage

    public function adminEpisodeHome()
    {
        $episodes = Episode::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%')->orderBy('episode_number', 'asc');
        })
            ->join('animes', 'episodes.anime_id', 'animes.id')
            ->select('episodes.*', 'animes.title')
            ->orderBy('id', 'desc')
            ->paginate(20);

        $episodes->appends(request()->all());
        $tabName = "episode";
        return view('admin.adminEpisodeHomepage', compact('episodes', 'tabName'));
    }

    //Sortings

    public function episodesidsort()
    {
        $episodes = Episode::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%')->orderBy('episode_number', 'asc');
        })
            ->join('animes', 'episodes.anime_id', 'animes.id')
            ->select('episodes.*', 'animes.title')
            ->orderBy('id', 'asc')
            ->paginate(20);

        $episodes->appends(request()->all());
        $tabName = "episode";

        return view('admin.adminEpisodeHomepage', compact('episodes', 'tabName'));
    }

    public function episodestitlesort()
    {
        $episodes = Episode::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%')->orderBy('episode_number', 'asc');
        })
            ->join('animes', 'episodes.anime_id', 'animes.id')
            ->select('episodes.*', 'animes.title')
            ->orderBy('animes.title', 'asc')
            ->orderBy('episode_number', 'asc')
            ->paginate(20);

        $episodes->appends(request()->all());
        $tabName = "episode";

        return view('admin.adminEpisodeHomepage', compact('episodes', 'tabName'));
    }

    //Admin Delete Episode

    public function episodesdelete($id, $number)
    {
        Episode::where('anime_id', $id)
            ->where('episode_number', $number)
            ->delete();

        $avaEpisode = Episode::where('anime_id', $id)
            ->count();
        $data['available_episode'] = $avaEpisode;
        Anime::where('id', $id)->update($data);

        return redirect()->route('admin#episode#home')->with(['Message' => 'Episode deleted successfully']);
    }
}
