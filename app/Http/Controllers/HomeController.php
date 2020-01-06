<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Image;
use App\Story;
use Illuminate\Http\Request;
use App\User;
use App\File as Files;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $followerId = [];
        $followers = Follower::where("from_id", $user_id)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get('to_id');
        foreach($followers as $follower) {
            $followerId[] = $follower->to_id;
        }

        $followerId[] = $user_id;

        $stories = Story::with("user")->whereIn("user_id", $followerId)->get();

        $images = Image::with(['user', 'likes','like' => function($query) use ($user_id) {
            $query->where("user_id", $user_id)->select("image_id");
        }])
            ->whereIn("user_id", $followerId)
            ->orderBy('id', 'desc')
            ->get();

        return view('home', compact('user', 'images', 'stories'));
    }

    public function select(Request $request)
    {
        return User::where('name', 'LIKE', '%'.$request->name.'%')
            ->where('id', '!=', Auth::user()->id)
            ->get();
    }

    public function updateProfile(Request $request)
    {
        $userInfo = auth()->user();

        $uploadImage = $request->pic;

        $fileName = str_random( 20);
        $format = explode('.', $uploadImage->getClientOriginalName());
        $fullName =  $fileName.'.'.end($format);
        $uploadImage->move('images/profile/'.$userInfo->id, $fullName);
        $path = '/images/profile/'.$userInfo->id.'/'.$fullName;
        if($userInfo->avatar != "/images/avatar.png") {
            File::delete($userInfo->avatar);
        }

        $userInfo->avatar = $path;
        $userInfo->save();

        return $userInfo;
    }
}
