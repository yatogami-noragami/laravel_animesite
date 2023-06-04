<?php

namespace App\Http\Controllers;

use App\Models\UserContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserContactController extends Controller
{

    //User Add New Contact

    public function contact()
    {
        return view('user.userContact');
    }

    public function contactAdmin(Request $req)
    {
        $id = Auth::user()->id;
        $description = $req->des;
        Validator::make($req->all(), [
            'des' => 'required'
        ])->validate();
        $data = $this->contactReturn($id, $description);
        UserContact::create($data);
        return back()->with(['Message' => 'Message delivered succesfully']);
    }

    private function contactReturn($id, $description)
    {
        return [
            'user_id' => $id,
            'description' => $description,
        ];
    }
}
