<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anime;
use App\Models\Movie;
use App\Models\UserContact;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{

    //Admin Anime Search

    public function animeSearch($key)
    {
        $animes = Anime::where('title', 'like', $key . '%')->orderBy('title')->take(5)->get();
        return $animes;
    }

    //Admin Movie Search

    public function movieSearch($key)
    {
        $movies = Movie::where('title', 'like', $key . '%')->orderBy('title')->take(5)->get();
        return $movies;
    }

    //Admin User Homepage

    public function adminHome()
    {
        $users = User::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'desc')->paginate(10);
        $users->appends(request()->all());
        $tabName = "home";
        $loginId = Auth::user()->id;
        $adminCount = User::where('role', '=', 'admin')->count();
        $userCount = User::where('role', '=', 'user')->count();
        return view('admin.adminHomePage', compact('users', 'tabName', 'loginId', 'adminCount', 'userCount'));
    }

    //Sortings

    public function usersidsort()
    {
        $users = User::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('id', 'asc')->paginate(10);
        $users->appends(request()->all());
        $tabName = "home";
        $loginId = Auth::user()->id;
        $adminCount = User::where('role', '=', 'admin')->count();
        $userCount = User::where('role', '=', 'user')->count();
        return view('admin.adminHomePage', compact('users', 'tabName', 'loginId', 'adminCount', 'userCount'));
    }

    public function usersnamesort()
    {
        $users = User::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('name', 'asc')->paginate(10);
        $users->appends(request()->all());
        $tabName = "home";
        $loginId = Auth::user()->id;
        $adminCount = User::where('role', '=', 'admin')->count();
        $userCount = User::where('role', '=', 'user')->count();
        return view('admin.adminHomePage', compact('users', 'tabName', 'loginId', 'adminCount', 'userCount'));
    }

    public function usersemailsort()
    {
        $users = User::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('email', 'asc')->paginate(10);
        $users->appends(request()->all());
        $tabName = "home";
        $loginId = Auth::user()->id;
        $adminCount = User::where('role', '=', 'admin')->count();
        $userCount = User::where('role', '=', 'user')->count();
        return view('admin.adminHomePage', compact('users', 'tabName', 'loginId', 'adminCount', 'userCount'));
    }

    public function usersrolesort()
    {
        $users = User::when(request('key'), function ($query) {
            $query->where('name', 'like',  request('key') . '%');
        })
            ->orderBy('role', 'asc')->paginate(10);
        $users->appends(request()->all());
        $tabName = "home";
        $loginId = Auth::user()->id;
        $adminCount = User::where('role', '=', 'admin')->count();
        $userCount = User::where('role', '=', 'user')->count();
        return view('admin.adminHomePage', compact('users', 'tabName', 'loginId', 'adminCount', 'userCount'));
    }

    //Admin Delete User

    public function usersdelete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin#home')->with(['Message' => 'Deleted successfully']);
    }

    //Admin Promote User

    public function userspromote($id)
    {
        $data['role'] = 'admin';
        User::where('id', $id)->update($data);
        return redirect()->route('admin#home')->with(['Message' => 'Promoted successfully']);
    }

    //Admin Downgrade USer

    public function usersdowngrade($id)
    {
        $data['role'] = 'user';
        User::where('id', $id)->update($data);
        return redirect()->route('admin#home')->with(['Message' => 'Downgraded successfully']);
    }

    //Admin Requests

    public function adminHomeNoti($number)
    {
        if ($number == '012') {
            $requests = UserRequest::join('users', 'user_requests.user_id', 'users.id')
                ->select('user_requests.*', 'users.name')
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } elseif ($number == '0') {
            $requests = UserRequest::join('users', 'user_requests.user_id', 'users.id')
                ->where('status', 0)
                ->orderBy('id', 'desc')
                ->select('user_requests.*', 'users.name')
                ->paginate(10);
        } elseif ($number == '1') {
            $requests = UserRequest::join('users', 'user_requests.user_id', 'users.id')
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->select('user_requests.*', 'users.name')
                ->paginate(10);
        } elseif ($number == '2') {
            $requests = UserRequest::join('users', 'user_requests.user_id', 'users.id')
                ->where('status', 2)
                ->orderBy('id', 'desc')
                ->select('user_requests.*', 'users.name')
                ->paginate(10);
        }
        return view('admin.adminHomeNoti', compact('requests'));
    }

    //Admin Contacts

    public function adminHomeNoti2($number)
    {
        if ($number == '012') {
            $contacts = UserContact::join('users', 'user_contacts.user_id', 'users.id')
                ->select('user_contacts.*', 'users.name')
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } elseif ($number == '0') {
            $contacts = UserContact::join('users', 'user_contacts.user_id', 'users.id')
                ->where('status', 0)
                ->select('user_contacts.*', 'users.name')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } elseif ($number == '1') {
            $contacts = UserContact::join('users', 'user_contacts.user_id', 'users.id')
                ->where('status', 1)
                ->select('user_contacts.*', 'users.name')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } elseif ($number == '2') {
            $contacts = UserContact::join('users', 'user_contacts.user_id', 'users.id')
                ->where('status', 2)
                ->select('user_contacts.*', 'users.name')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('admin.adminHomeNoti2', compact('contacts'));
    }

    //Admin Reject Request

    public function requestReject($id)
    {
        $data['status'] = 2;
        UserRequest::where('id', $id)->update($data);
        return back();
    }

    //Admin Fullfill Request

    public function requestFullfill($id)
    {
        $data['status'] = 1;
        UserRequest::where('id', $id)->update($data);
        return back();
    }

    //Admin Reject Contact

    public function contactReject($id)
    {
        $data['status'] = 2;
        UserContact::where('id', $id)->update($data);
        return back();
    }

    //Admin Fullfill Contact

    public function contactFullfill($id)
    {
        $data['status'] = 1;
        UserContact::where('id', $id)->update($data);
        return back();
    }
}