<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index($id)
    {
        $guestInfo = User::with( 'files')->find($id);

        return view('guest.index', compact('guestInfo'));
    }

    public function getGuestImages($id)
    {
        $guestImages = Image::where('file_id', $id)->get();

        return view('guest.guestImages', compact('guestImages'));
    }

}
