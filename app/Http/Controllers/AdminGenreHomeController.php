<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminGenreHomeController extends Controller
{
    //Admin Genre Homepage

    public function adminGenreHome()
    {
        $genres = Genre::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(20);
        $genres->appends(request()->all());
        $tabName = "genre";
        return view('admin.adminGenreHomepage', compact('genres', 'tabName'));
    }

    //Sortings

    public function genresidsort()
    {
        $genres = Genre::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(20);
        $genres->appends(request()->all());
        $tabName = "genre";
        return view('admin.adminGenreHomepage', compact('genres', 'tabName'));
    }

    public function genresnamesort()
    {
        $genres = Genre::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('name', 'asc')
            ->paginate(20);
        $genres->appends(request()->all());
        $tabName = "genre";
        return view('admin.adminGenreHomepage', compact('genres', 'tabName'));
    }

    //Admin Edit Genre

    public function genresedit($id)
    {
        $genre = Genre::where('id', $id)->first();
        return view('admin.adminGenreEdit', compact('genre'));
    }

    public function genresupdate(Request $req)
    {
        $id = $req->genreId;
        Validator::make($req->all(), [
            'name' => 'required|unique:genres,name,' . $id,
        ])->validate();

        $data['name'] = $req->name;
        Genre::where('id', $id)->update($data);
        return redirect()->route('admin#genre#home')->with(['Message' => 'Genre edited successfully']);
    }

    //Admin Delete Genre

    public function genresdelete($id)
    {
        Genre::where('id', $id)->delete();
        return redirect()->route('admin#genre#home')->with(['Message' => 'Genre deleted successfully']);
    }
}
