<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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

        return view('home', compact('user'));
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
