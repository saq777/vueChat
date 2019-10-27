<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Messenger;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{
    public function index()
    {
        $myInfo = Auth::user();

        $part = $this->getNewPartners($myInfo);

        return view('chat', compact('part', 'myInfo'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'message' => 'required',
            'from_id' => 'required|exists:users,id',
            'to_id' => 'required|exists:users,id',
        ]);

        $message = Messenger::create($data);
        $user = Auth::user();

        broadcast(new MessageSent($user, $message))->toOthers();

        return $message;
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

    public function getNewPartners()
    {

        $part = [];
        $user_id = Auth::user()->id;
        $partners = Messenger::with('user')->where('from_id', $user_id)->orWhere('to_id', $user_id)->get();


        foreach($partners as $partner) {
            if($partner->user->id == $user_id) {
                $part[] = User::find($partner->from_id);
            } else {
                $part[] = $partner->user;
            }
        }

        return array_unique($part);
    }

}
