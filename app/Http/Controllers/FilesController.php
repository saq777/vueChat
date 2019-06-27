<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{

    public function index()
    {
        $myInfo = Auth::user();
        $files = File::where('user_id', $myInfo->id)->get();

        return view('posts.filesGroup', compact( 'myInfo', 'files'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required'
        ]);

        $lastCreate = File::create($request->toArray());
        return $lastCreate;
    }

    public function delete(Request $request)
    {
        $request->validate([
            'file_id' => 'required|exists:files,id',
        ]);

        File::find($request->file_id)->delete();
    }
}
