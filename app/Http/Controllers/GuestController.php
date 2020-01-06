<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Image;
use App\Mail\FollowMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    public function index($id)
    {
        $user_id = Auth::user()->id;
        $guestInfo = User::with( ['files', 'follower' => function($query) use ($user_id) {
            $query->where("from_id", $user_id);
        }])->find($id);

        $images = Image::with(['user', 'likes','like' => function($query) use ($user_id) {
            $query->where("user_id", $user_id)->select("image_id");
        }])
            ->where("user_id", $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('guest.index', compact('guestInfo', 'images'));
    }

    public function getGuestImages($id)
    {
        $guestImages = Image::where('file_id', $id)->get();

        return view('guest.guestImages', compact('guestImages'));
    }

    public function unFollow($follow_id)
    {
        Log::info("--start follow process--");
        Log::info("guest id = ".$follow_id);
        $follow = Follower::find($follow_id);

        if(!is_null($follow)) {
            $follow->delete();
            dd($follow);
            Log::info("User unFollow successfully");
        } else {
            $follow = false;
            Log::info("User does not follow");
        }

        return response()->json([
            "success" => $follow
        ]);
    }

    public function  follow($guest_id)
    {
        $data = [
            "from_id" => Auth::user()->id,
            "to_id" => $guest_id
        ];
        try {
            $follow = Follower::create($data);
            return $follow;
        } catch (\Exception $e) {
            Log::info("Something went wrong, follow doesn't success");
            Log::info("follow ".$e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong, follow doesn't success",
            ]);
        }
    }
}
