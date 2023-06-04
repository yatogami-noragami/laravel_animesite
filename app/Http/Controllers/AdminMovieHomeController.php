<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminMovieHomeController extends Controller
{

    //Admin Movie Homepage

    public function adminMovieHome()
    {
        $genreSelected = null;
        $movies = Movie::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $movies->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "movie";

        return view('admin.adminMovieHomepage', compact('movies', 'genreSelected', 'genres', 'tabName'));
    }

    //Sortings

    public function moviesidsort()
    {
        $genreSelected = null;
        $movies = Movie::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(10);
        $movies->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "movie";

        return view('admin.adminMovieHomepage', compact('movies', 'genreSelected', 'genres', 'tabName'));
    }

    public function moviestitlesort()
    {
        $genreSelected = null;
        $movies = Movie::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->orderBy('title', 'asc')
            ->paginate(10);
        $movies->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "movie";

        return view('admin.adminMovieHomepage', compact('movies', 'genreSelected', 'genres', 'tabName'));
    }

    public function moviesgenresort(Request $req)
    {
        $genreSelected = $req->genre;
        $movies = Movie::when(request('key'), function ($query) {
            $query->where('title', 'like',  request('key') . '%');
        })
            ->where('genre', 'like', '%' . $genreSelected . '%')
            ->orderBy('genre', 'asc')
            ->paginate(10);
        $movies->appends(request()->all());
        $genres = Genre::orderBy('name', 'asc')->get();
        $tabName = "movie";
        return view('admin.adminMovieHomepage', compact('movies', 'genres', 'genreSelected', 'tabName'));
    }

    //Admin View Movie Details

    public function moviesview($id)
    {
        $movie = MOvie::where('id', $id)->first();
        return view('admin.adminMovieDetails', compact('movie'));
    }

    //Admin Edit Movie Details

    public function moviesedit($id)
    {
        $movie = Movie::where('id', $id)->first();
        $genres = Genre::orderBy('name', 'asc')->get();
        $genreString = $movie->genre;
        $genreArray = explode(',', $genreString);
        return view('admin.adminMovieEdit', compact('movie', 'genres', 'genreArray'));
    }

    public function moviesupdate(Request $req, $image)
    {

        $this->updateValidator($req);
        $data = $this->updatereturn($req);
        $id = $req->movieId;
        if ($req->hasFile('movieImage')) {
            $fileName = uniqid() . '_' . $req->movieTitle . '_' . $req->movieImage->getClientOriginalName();
            $req->file('movieImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;

            Storage::delete('public/' . $image);
        }
        Movie::where('id', $id)->update($data);
        return redirect()->route('admin#movie#home#view', $id);
    }

    private function updateValidator($req)
    {
        Validator::make($req->all(), [
            'movieTitle' => 'required',
            'movieImage' => 'mimes:jpg,jpeg,png',
            'movieYear' => 'required|numeric|min:2000|max:2023',
            'movieRating' => 'required|numeric|min:1|max:9',
            'animeGenres' => 'required',
        ])->validate();
    }

    private function updateReturn($req)
    {
        return [
            'title' => $req->movieTitle,
            'description' => $req->movieDes,
            'year' => $req->movieYear,
            'rating' => $req->movieRating,
            'genre' => $req->animeGenres,
            'updated_at' => Carbon::now(),
        ];
    }

    //Admin Delete Movie

    public function moviesdelete($id)
    {
        Movie::where('id', $id)->delete();
        return redirect()->route('admin#movie#home')->with(['Message' => 'Movie deleted successfully']);
    }
}
