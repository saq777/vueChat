<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Messenger;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index(Request $request)
    {

        return User::where('name', 'LIKE', '%'.$request->name.'%')->get();
    }

    public function guestPage($id)
    {
        $myInfo = Auth::user();

        $messages = Messenger::Where(function($query) use ($myInfo, $id)
        {
            $query->where("to_id",$id)
                ->where("from_id",$myInfo->id);
        })
            ->orWhere(function($query) use ($myInfo, $id)
            {
                $query->Where("to_id",$myInfo->id)
                    ->Where("from_id",$id);
            })
            ->get();

        $guestUser = User::find($id);

        return view('guest.guest', compact('messages', 'guestUser', 'myInfo'));
    }
}
