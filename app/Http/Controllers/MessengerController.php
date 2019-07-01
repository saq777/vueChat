<?php

namespace App\Http\Controllers;

use App\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            'message' => 'required',
            'from_id' => 'required|exists:users,id',
            'to_id' => 'required|exists:users,id',
        ]);

        $message = Messenger::create($data);
        return $message->id;
    }

    public function getLastMessages(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:messenger,id',
        ]);

       return Messenger::where('id', '>', $data['id'])->get();
    }
}
