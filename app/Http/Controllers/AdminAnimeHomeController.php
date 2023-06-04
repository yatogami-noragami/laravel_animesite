<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Anime;
use App\Models\Genre;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAnimeHomeController extends Controller
{
    //Admin Anime Homepage

    public function adminAnimeHome()
    {
        $genreSelected = null;
        $animes = Anime::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "anime";
        return view('admin.adminAnimeHomepage', compact('animes', 'genres', 'genreSelected', 'tabName'));
    }

    //Sortings

    public function animesidsort()
    {
        $genreSelected = null;
        $animes = Anime::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'asc')->paginate(10);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "anime";
        return view('admin.adminAnimeHomepage', compact('animes', 'genres', 'genreSelected', 'tabName'));
    }

    public function animestitlesort()
    {
        $genreSelected = null;
        $animes = Anime::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->orderBy('title', 'asc')->paginate(10);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "anime";
        return view('admin.adminAnimeHomepage', compact('animes', 'genres', 'genreSelected', 'tabName'));
    }

    public function animesgenresort(Request $req)
    {
        $genreSelected = $req->genre;
        $animes = Anime::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->where('genre', 'like', '%' . $genreSelected . '%')
            ->orderBy('genre', 'asc')
            ->paginate(10);
        $animes->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "anime";
        return view('admin.adminAnimeHomepage', compact('animes', 'genres', 'genreSelected', 'tabName'));
    }

    //Admin View Anime

    public function animesview($id)
    {
        $anime = Anime::where('id', $id)->first();
        return view('admin.adminAnimeDetails', compact('anime'));
    }

    //Admin Add new Episode

    public function animesepisodeadd($id)
    {
        $anime = Anime::where('id', $id)->first();
        $episodes = Episode::where('anime_id', $id)
            ->orderBy('episode_number', 'asc')
            ->get();
        $episodeCount = Episode::where('anime_id', $id)->max('episode_number');
        return view('admin.adminEpisodeAdd', compact('anime', 'episodes', 'episodeCount'));
    }

    public function animesepisodeaddnew(Request $req)
    {
        $id = $req->animeId;
        $episodeLimit = Anime::where('id', $id)->first()->episode_count;;
        $lastEpisode = Episode::where('anime_id', $id)
            ->max('episode_number');
        Validator::make($req->all(), [
            // 'episodeNumber' => 'required|numeric|min:' . $lastEpisode + 1 . '|max:' . $lastEpisode + 1,

            'episodeNumber' => [
                'required',
                'numeric',
                'min:1',
                Rule::unique('episodes', 'episode_number')
                    ->where('anime_id', '*', '!=', $id),
                'max:' . $episodeLimit,
            ],
        ])->validate();

        $episodeCheck = Episode::where('anime_id', $id)
            ->where('episode_number', $req->episodeNumber)
            ->get();
        if ($episodeCheck->count() != 0) {
            return back()->with(['Message' => 'Episode already exists,check the list below.']);
        } else {
            $data = $this->addReturn($req, $id);
            Episode::create($data);
            $data2['available_episode'] = Episode::where('anime_id', $id)->count();
            Anime::where('id', $id)->update($data2);
            return back()->with(['Message' => 'Episode added successfully']);
        }
    }

    private function addReturn($req, $id)
    {
        return [
            'anime_id' => $id,
            'episode_number' => $req->episodeNumber,
        ];
    }

    //Admin Edit Anime Details

    public function animesedit($id)
    {
        $anime = Anime::where('id', $id)->first();
        $genres = Genre::orderBy('name', 'asc')->get();
        $genreString = $anime->genre;
        $genreArray = explode(',', $genreString);
        return view('admin.adminAnimeEdit', compact('anime', 'genres', 'genreArray'));
    }

    public function animesupdate(Request $req, $image)
    {
        $this->updateValidator($req);
        $data = $this->updatereturn($req);
        $id = $req->animeId;
        if ($req->hasFile('animeImage')) {
            $fileName = uniqid() . '_' . $req->animeTitle . '_' . $req->animeImage->getClientOriginalName();
            $req->file('animeImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;

            Storage::delete('public/' . $image);
        }
        Anime::where('id', $id)->update($data);
        return redirect()->route('admin#anime#home#view', $id);
    }

    private function updateValidator($req)
    {
        Validator::make($req->all(), [
            'animeTitle' => 'required',
            'animeImage' => 'mimes:jpg,jpeg,png',
            'animeYear' => 'required|numeric|min:2000|max:2023',
            'animeRating' => 'required|numeric|min:1|max:9',
            'animeEpisode' => 'required|numeric|min:' . $req->animePreEpisode,
            'animeGenres' => 'required',
            'updated_at' => Carbon::now(),
        ])->validate();
    }

    private function updateReturn($req)
    {
        return [
            'title' => $req->animeTitle,
            'description' => $req->animeDes,
            'year' => $req->animeYear,
            'rating' => $req->animeRating,
            'episode_count' => $req->animeEpisode,
            'genre' => $req->animeGenres,
            'updated_at' => Carbon::now(),
        ];
    }

    //Admin Delete Anime

    public function animesdelete($id)
    {
        Anime::where('id', $id)->delete();
        return redirect()->route('admin#anime#home')->with(['Message' => 'Anime deleted successfully']);
    }

    //Admin Add New Batch Episode

    public function animesepisodeaddnewbatch(Request $req)
    {
        $id = $req->animeId;
        $episodeLimit = $req->episodeLimit;
        $preEpisode = $req->preEpisode;
        if ($preEpisode == 0) {
            Validator::make($req->all(), [
                'episodeTotalNumber' => 'required|numeric|min:1|max:' . $episodeLimit,
            ])->validate();
            for ($i = 1; $i <= $req->episodeTotalNumber; $i++) {
                $data = $this->addReturnBatch($i, $id);
                Episode::create($data);
            }
            $data2['available_episode'] = $req->episodeTotalNumber;
            Anime::where('id', $id)->update($data2);
        } else {
            Validator::make($req->all(), [
                'episodeTotalNumber' => 'required|numeric|min:1|max:' . $episodeLimit - $preEpisode,
            ])->validate();
            for ($i = $preEpisode + 1; $i <= $req->episodeTotalNumber + $preEpisode; $i++) {
                $data = $this->addReturnBatch($i, $id);
                Episode::create($data);
            }
            $data2['available_episode'] = Episode::where('anime_id', $id)->count();
            Anime::where('id', $id)->update($data2);
        }

        return back()->with(['Message' => 'Episode added successfully']);
    }

    private function addReturnBatch($i, $id)
    {
        return [
            'anime_id' => $id,
            'episode_number' => $i,
        ];
    }
}
