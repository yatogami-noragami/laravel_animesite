<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anime;
use App\Models\Movie;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class AdminBookmarkHomeController extends Controller
{
    //Admin Bookmark Homepage

    public function adminBookmarkHome()
    {
        $bookmarks = Bookmark::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'bookmarks.user_id', 'users.id')
            ->select('bookmarks.*', 'users.name')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $bookmarks->appends(request()->all());
        $tabName = "bookmark";
        return view('admin.adminBookmarkHomepage', compact('bookmarks', 'tabName'));
    }

    //Sortings

    public function bookmarksidsort()
    {
        $bookmarks = Bookmark::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'bookmarks.user_id', 'users.id')
            ->select('bookmarks.*', 'users.name')
            ->orderBy('id', 'asc')
            ->paginate(10);
        $bookmarks->appends(request()->all());
        $tabName = "bookmark";
        return view('admin.adminBookmarkHomepage', compact('bookmarks', 'tabName'));
    }

    public function bookmarksusernamesort()
    {
        $bookmarks = Bookmark::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'bookmarks.user_id', 'users.id')
            ->select('bookmarks.*', 'users.name')
            ->orderBy('users.name', 'asc')
            ->paginate(10);
        $bookmarks->appends(request()->all());
        $tabName = "bookmark";
        return view('admin.adminBookmarkHomepage', compact('bookmarks', 'tabName'));
    }

    public function bookmarksanimenamesort()
    {
        $bookmarks = Bookmark::when(request('key'), function ($query) {
            $query->where('users.name', 'like',  request('key') . '%');
        })
            ->join('users', 'bookmarks.user_id', 'users.id')
            ->select('bookmarks.*', 'users.name')
            ->orderBy('anime_name', 'asc')
            ->paginate(10);
        $bookmarks->appends(request()->all());
        $tabName = "bookmark";
        return view('admin.adminBookmarkHomepage', compact('bookmarks', 'tabName'));
    }

    //Admin View Bookmark Details

    public function bookmarksview($id)
    {
        $bookmark = Bookmark::where('id', $id)->first();
        $userName = $bookmark->user_id;
        $userName = User::where('id', $userName)->first();
        $userName = $userName->name;
        $bookmarks = explode(',', $bookmark->anime_name);

        foreach ($bookmarks as $bookmark) {
            $anime = Anime::where('title', $bookmark)->first();
            if ($anime) {
                $animeArray[] = $anime;
            }
        }

        foreach ($bookmarks as $bookmark) {
            $movie = Movie::where('title', $bookmark)->first();
            if ($movie) {
                $movieArray[] = $movie;
            }
        }

        return view('admin.adminBookmarkDetails', compact('animeArray', 'movieArray', 'userName'));
    }

    //Admin Delete Bookmark

    public function bookmarksdelete($id)
    {
        Bookmark::where('user_id', $id)->delete();
        return redirect()->route('admin#bookmark#home')->with(['Message' => 'Bookmark deleted successfully']);
    }
}