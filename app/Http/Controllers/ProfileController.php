<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anime;
use App\Models\Movie;
use App\Models\Bookmark;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //View Profile

    public function profile()
    {
        $bookmarks = null;
        $animeArray = [];
        $movieArray = [];

        if (Auth::user()->role == "user") {
            $id = Auth::user()->id;
            $bookmark = Bookmark::where('user_id', $id)->first();
            if ($bookmark) {
                $bookmarks = explode(',', $bookmark->anime_name);

                foreach ($bookmarks as $bookmark) {
                    $anime = Anime::where('title', $bookmark)->first();
                    if ($anime) {
                        $titles[] = $anime->title;
                        $images[] = $anime->image;
                        $animeArray = array_combine($titles, $images);
                    }
                }

                foreach ($bookmarks as $bookmark) {
                    $movie = Movie::where('title', $bookmark)->first();
                    if ($movie) {
                        $titlesTwo[] = $movie->title;
                        $imagesTwo[] = $movie->image;
                        $movieArray = array_combine($titlesTwo, $imagesTwo);
                    }
                }
            }
        }

        return view('profile', compact('animeArray', 'movieArray'));
    }

    //Edit Profile Details

    public function edit()
    {
        return view('profileEdit');
    }

    //Change Password

    public function change()
    {
        return view('profileChange');
    }

    //Edit Profile Details

    public function editForm(Request $req)
    {
        $this->editValidator($req);
        $data = $this->editReturn($req);
        $id = Auth::user()->id;
        if ($req->hasFile('image')) {
            $fileName = uniqid() . '_' . $req->role . '_' . $req->name . '_' . $req->file('image')->getClientOriginalName();
            $data['image'] = $fileName;
            $req->file('image')->storeAs('public', $fileName);

            if (Auth::user()->image) {
                $dbName = Auth::user()->image;
                Storage::delete('public/' . $dbName);
            }
        }

        User::where('id', $id)->update($data);
        return redirect()->route('profile')->with(['Message' => 'Account details edited successfully']);
    }

    private function editValidator($req)
    {
        Validator::make($req->all(), [
            'name' => 'required|unique:users,name,' . Auth::user()->id,
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'image' => 'mimes:jpg,jpeg,png'
        ])->validate();
    }

    private function editReturn($req)
    {
        return [
            'name' => $req->name,
            'email' => $req->email,
            'updated_at' => Carbon::now(),
        ];
    }

    //Change Password

    public function changeForm(Request $req)
    {
        $this->changeValidator($req);
        $id = Auth::user()->id;
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        $clientPassword = $req->oldPassword;

        if (Hash::check($clientPassword, $dbPassword)) {
            $newPassword = Hash::make($req->confirmPassword);
            $data['password'] = $newPassword;
            $data['updated_at'] = Carbon::now();
            User::where('id', $id)->update($data);
            Auth::logout();
            return redirect()->route('loginPage');
        } else {
            return back()->with(['Message' => 'Old password does not match']);
        }
    }

    private function changeValidator($req)
    {
        Validator::make($req->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
