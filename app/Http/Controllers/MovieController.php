<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{

    //User Add New Movie

    public function newmovie()
    {
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('admin.adminNewMovie', compact('genres'));
    }

    public function createMovie(Request $req)
    {
        $this->createValidator($req);
        $data = $this->createReturn($req);
        if ($req->hasFile('movieImage')) {
            $fileName = uniqid() . '_' . $req->movieTitle . '_' . $req->movieImage->getClientOriginalName();
            $req->file('movieImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Movie::create($data);
        return back()->with(['Message' => 'New movie added successfully']);
    }

    private function createValidator($req)
    {
        Validator::make($req->all(), [
            'movieTitle' => 'required',
            'movieImage' => 'mimes:jpg,jpeg,png',
            'movieYear' => 'required|numeric|min:2000|max:2023',
            'movieRating' => 'required|numeric|min:1|max:9',
            'animeGenres' => 'required',
        ])->validate();
    }

    private function createReturn($req)
    {
        return [
            'title' => $req->movieTitle,
            'description' => $req->movieDes,
            'year' => $req->movieYear,
            'rating' => $req->movieRating,
            'genre' => $req->animeGenres,
        ];
    }
}
