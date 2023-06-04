<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    //Admin Add New Genre

    public function newGenre()
    {
        return view('admin.adminNewGenre');
    }

    public function createGenre(Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required|unique:genres,name,' . $req->id,
        ])->validate();
        $data['name'] = $req->name;
        Genre::create($data);
        return back()->with(['Message' => 'New genre added successfully']);
    }
}
