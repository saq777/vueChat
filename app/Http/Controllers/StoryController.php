<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required|exists:users,id",
            "image"   => "required",
        ]);

        $data = $request->all();
    }
}
