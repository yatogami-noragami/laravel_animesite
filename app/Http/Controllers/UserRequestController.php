<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Movie;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRequestController extends Controller
{

    //User Add New Request

    public function request()
    {
        return view('user.userRequest');
    }

    public function requestAnime(Request $req)
    {
        $id = Auth::user()->id;
        $animeName = $req->animeTitle;
        $check = Anime::where('title', $animeName)->first();
        $check2 = Movie::where('title', $animeName)->first();
        if ($check) {
            return back()->with(['Message' => 'Request anime already esists.']);
        } else if ($check2) {
            return back()->with(['Message' => 'Request movie already esists.']);
        } else {
            Validator::make($req->all(), [
                'animeTitle' => 'required'
            ])->validate();
            $data = $this->requestReturn($id, $animeName);
            UserRequest::create($data);
            return back()->with(['Message' => 'Requested successfully']);
        }
    }

    private function requestReturn($id, $animeName)
    {
        return [
            'user_id' => $id,
            'title' => $animeName,
        ];
    }
}
