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
            'from_id' => 'required|exists:users,id',
            'to_id' => 'required|exists:users,id',
        ]);

        $messages = Messenger::Where(function($query) use ($request, $data)
       {
           $query->where("from_id",$request->from_id)
               ->where("to_id",$request->to_id)
               ->where('id', '>', $data['id']);
       })
           ->orWhere(function($query) use ($request, $data)
           {
               $query->Where("from_id",$request->to_id)
                   ->Where("to_id",$request->from_id)
                   ->where('id', '>', $data['id']);
           })
           ->get();

        return json_encode($messages);
    }

    public function getMessages(Request $request)
    {
        $messages = Messenger::Where(function($query) use ($request)
        {
            $query->where("from_id",$request->from_id)
                ->where("to_id",$request->to_id);
        })
            ->orWhere(function($query) use ($request)
            {
                $query->Where("from_id",$request->to_id)
                    ->Where("to_id",$request->from_id);
            })
            ->get();

        return json_encode($messages);
    }
}
