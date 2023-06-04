<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Movie;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{

    //User Add New Bookmark

    public function bookmarkAdd(Request $req)
    {
        $id = Auth::user()->id;
        $data['user_id'] = $id;

        $bookmarkCheck = Bookmark::where('user_id', $id)->first();
        if ($bookmarkCheck == null) {
            Bookmark::create($data);
        }
        $bookmarkCheck = Bookmark::where('user_id', $id)->first();
        $oldBookmark = $bookmarkCheck->anime_name;
        $data = $this->bookmarkReturn($req, $id, $oldBookmark);
        Bookmark::where('user_id', $id)->update($data);
        return back();
    }

    private function bookmarkReturn($req, $id, $oldBookmark)
    {
        return [
            'user_id' => $id,
            'anime_name' => $oldBookmark . $req->animeName,
        ];
    }

    //User Remove Bookmark

    public function bookmarkRemove(Request $req)
    {
        $id = Auth::user()->id;
        $oldBookmark = Bookmark::where('user_id', $id)->first();
        $oldBookmark = $oldBookmark->anime_name;
        $newBookmark = str_replace($req->animeName, "",  $oldBookmark);
        $data = $this->bookmarkReturn2($id, $newBookmark);
        Bookmark::where('user_id', $id)->update($data);
        return back();
    }

    private function bookmarkReturn2($id, $newBookmark)
    {
        return [
            'user_id' => $id,
            'anime_name' => $newBookmark,
        ];
    }

    //User Show Bookmark

    public function bookmarkToAnime($animename, $type)
    {
        if ($type == 'anime') {
            $animeId = Anime::where('title', $animename)->first();
            return redirect()->route('user#anime#details', $animeId->id);
        } else {
            $animeId = Movie::where('title', $animename)->first();
            return redirect()->route('user#movie#details', $animeId->id);
        }
    }

    //User Delete All Bookmark

    public function animeBookmarkRemoveAll()
    {
        $id = Auth::user()->id;
        $bookmark = null;
        $data['anime_name'] = $bookmark;
        Bookmark::where('user_id', $id)->update($data);
        return back();
    }
}
