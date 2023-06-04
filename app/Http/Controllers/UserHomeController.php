<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller
{
    //User Anime Search

    public function animeSearch($key)
    {
        $animes = Anime::where('title', 'like', $key . '%')->orderBy('title')->take(5)->get();
        return $animes;
    }

    //USer Movie Search

    public function movieSearch($key)
    {
        $movies = Movie::where('title', 'like', $key . '%')->orderBy('title')->take(5)->get();
        return $movies;
    }

    //User Homepage

    public function userHome()
    {
        $episodes = Episode::when(request('search'), function ($query) {
            $query->where('title', 'like',  request('search') . '%');
        })
            ->join(DB::raw('(SELECT anime_id, MAX(episode_number) as latest_episode FROM episodes GROUP BY anime_id) latest_episodes'), function ($join) {
                $join->on('episodes.anime_id', '=', 'latest_episodes.anime_id')
                    ->on('episodes.episode_number', '=', 'latest_episodes.latest_episode')
                    ->join('animes', 'latest_episodes.anime_id', 'animes.id')
                    ->select('episodes.*', 'animes.title');
            })->orderBy('episodes.id', 'desc')
            ->paginate(16);
        $episodes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "home";
        return view('user.userHomepage', compact('episodes', 'tabName', 'genres'));
    }

    //User Popular Homepage

    public function userHomePopular()
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('view_count', 'desc')->paginate(16);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "popular";
        return view('user.userHomePopular', compact('animes', 'tabName', 'genres'));
    }

    //User Anime List Homepage

    public function userHomeAnimeList()
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('title', 'asc')->paginate(20);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "animelist";
        return view('user.userHomeAnimeList', compact('animes', 'tabName', 'genres'));
    }

    //User New Season Homepage

    public function userHomeNewSeason()
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('id', 'desc')->paginate(16);
        $animes->appends(request()->all());
        $tabName = "newseason";
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('user.userHomeNewSeason', compact('animes', 'tabName', 'genres'));
    }

    //User Movies Homepage

    public function userHomeMovies()
    {
        $animes = Movie::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('id', 'desc')->paginate(16);
        $animes->appends(request()->all());
        $tabName = "movies";
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('user.userHomeMovies', compact('animes', 'tabName', 'genres'));
    }

    //User Homepage Sorts

    public function userhomegenresort($name)
    {
        $episodes = Episode::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->where('genre', 'like', '%' . $name . '%')
            ->join(DB::raw('(SELECT anime_id, MAX(episode_number) as latest_episode FROM episodes GROUP BY anime_id) latest_episodes'), function ($join) {
                $join->on('episodes.anime_id', '=', 'latest_episodes.anime_id')
                    ->on('episodes.episode_number', '=', 'latest_episodes.latest_episode')
                    ->join('animes', 'latest_episodes.anime_id', 'animes.id')
                    ->select('episodes.*', 'animes.title', '');
            })->orderBy('episodes.id', 'desc')
            ->paginate(16);
        $episodes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "home";
        return view('user.userHomepage', compact('episodes', 'tabName', 'genres'));
    }

    public function userhomenamesort()
    {
        $episodes = Episode::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->join(DB::raw('(SELECT anime_id, MAX(episode_number) as latest_episode FROM episodes GROUP BY anime_id) latest_episodes'), function ($join) {
                $join->on('episodes.anime_id', '=', 'latest_episodes.anime_id')
                    ->on('episodes.episode_number', '=', 'latest_episodes.latest_episode')
                    ->join('animes', 'latest_episodes.anime_id', 'animes.id')
                    ->select('episodes.*', 'animes.title');
            })->orderBy('animes.title', 'asc')
            ->paginate(16);
        // dd($episodes->toArray());
        $episodes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "home";
        return view('user.userHomepage', compact('episodes', 'tabName', 'genres'));
    }

    //User Anime List Sorts

    public function useranimelistgenresort($name)
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->where('genre', 'like', '%' . $name . '%')
            ->orderBy('title', 'asc')->paginate(16);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "animelist";
        return view('user.userHomeAnimeList', compact('animes', 'tabName', 'genres'));
    }

    public function useranimelistlettersort($letter)
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->where('title', 'like', $letter . '%')
            ->orderBy('title', 'asc')->paginate(200);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "animelist";
        return view('user.userHomeAnimeList', compact('animes', 'tabName', 'genres'));
    }

    //User New Season Sorts

    public function usernewseasonnamesort()
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like',  request('search') . '%');
        })->orderBy('title', 'asc')->paginate(16);
        $animes->appends(request()->all());
        $tabName = "newseason";
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('user.userHomeNewSeason', compact('animes', 'tabName', 'genres'));
    }

    public function usernewseasongenresort($name)
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->where('genre', 'like', '%' . $name . '%')
            ->orderBy('id', 'desc')->paginate(16);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "newseason";
        return view('user.userHomeNewSeason', compact('animes', 'tabName', 'genres'));
    }

    //User Movies Sorts

    public function usermoviesnamesort()
    {
        $animes = Movie::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('title', 'asc')->paginate(16);
        $animes->appends(request()->all());
        $tabName = "movies";
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('user.userHomeMovies', compact('animes', 'tabName', 'genres'));
    }

    public function usermoviesgenresort($name)
    {
        $animes = Movie::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->where('genre', 'like', '%' . $name . '%')
            ->orderBy('id', 'desc')->paginate(16);
        $animes->appends(request()->all());
        $tabName = "movies";
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('user.userHomeMovies', compact('animes', 'tabName', 'genres'));
    }

    //User Popular Sorts

    public function userpopularnamesort()
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })->orderBy('title', 'asc')->paginate(16);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "popular";
        return view('user.userHomePopular', compact('animes', 'tabName', 'genres'));
    }

    public function userpopulargenresort($name)
    {
        $animes = Anime::when(request('search'), function ($query) {
            $query->where('title', 'like', request('search') . '%');
        })
            ->where('genre', 'like', '%' . $name . '%')
            ->orderBy('id', 'desc')->paginate(16);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "popular";
        return view('user.userHomePopular', compact('animes', 'tabName', 'genres'));
    }
}