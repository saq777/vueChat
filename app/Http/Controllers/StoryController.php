<?php

namespace App\Http\Controllers;

use App\Jobs\HideStories;
use App\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "image"   => "required|image",
        ]);

        $data = $request->all();
        $myInfo = auth()->user();

        $fileName = str_random( 20);
        $format = explode('.', $data['image']->getClientOriginalName());
        $fullName =  $fileName.'.'.end($format);
        $path = "images/story-".$myInfo->id;
        $data['image']->move($path, $fullName);

        $data['user_id'] = $myInfo->id;
        $data['image'] = $path.'/'.$fullName;

        $story = Story::create($data);

        Log::info("Story hide after 24 hours where id = $story->id");
        HideStories::dispatch($story->id)
            ->delay(Carbon::now()->addDay());

    }
}
