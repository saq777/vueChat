<?php

namespace App\Http\Controllers;

use App\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{
    public function index()
    {
        $myInfo = Auth::user();

        $messages = Messenger::with('user')->get();
        return view('messenger.index', compact('messages', 'myInfo'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'message' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $message = Messenger::create($data);
        return $message->id;
    }

    public function getLastMessages(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:messenger,id',
        ]);

       return Messenger::with('user')->where('id', '>', $data['id'])->get();
    }
}
