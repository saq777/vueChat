<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Image;
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
        $user = Auth::user();
        $user_id = $user->id;
        $followerId = [];
        $followers = Follower::where("from_id", $user_id)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get('to_id');
        foreach($followers as $follower) {
            $followerId[] = $follower->to_id;
        }

        $images = Image::with(['user', 'likes','like' => function($query) use ($user_id) {
            $query->where("user_id", $user_id)->select("image_id");
        }])
            ->whereIn("user_id", $followers)
            ->orderBy('id', 'desc')
            ->get();

        return view('home', compact('user', 'images'));
    }

    public function select(Request $request)
    {
        return User::where('name', 'LIKE', '%'.$request->name.'%')
            ->where('id', '!=', Auth::user()->id)
            ->get();
    }

    public function updateProfile(Request $request)
    {
        $userInfo = Auth::user();

        $uploadImage = $request->pic;

        $fileName = str_random( 20);
        $format = explode('.', $uploadImage->getClientOriginalName());
        $fullName =  $fileName.'.'.end($format);
        $path = $uploadImage->move('images/profile/'.$userInfo->id, $fullName);
//        if(File::exists('images/profile/'.$userInfo->id)) {
            File::delete('images/profile/'.$userInfo->id.'/'.$userInfo->avatar);
//        }

        $user = User::find($userInfo->id);
        $user->avatar = $fullName;
        $user->save();

        return $user;
    }
}
