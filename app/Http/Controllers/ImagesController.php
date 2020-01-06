<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ImagesController extends Controller
{
    public function index($folderId)
    {

        $myInfo = Auth::user();

        $images = Image::with('file')->where('user_id', $myInfo->id)->where('file_id', $folderId)->get();

        return view('posts.upload-images', compact('images', 'myInfo', 'folderId'));
    }

    public function uploadImage(Request $request)
    {
        $file = $request->files;
        $uploadedImages = $request->pics;
        $folderId = $request->folderId;
        $myInfo = Auth::user();

        $allImages = [];
        foreach($uploadedImages as $image)
        {

            $fileName = str_random( 20);
            $format = explode('.', $image->getClientOriginalName());
            $fullName =  $fileName.'.'.end($format);
            $image->move('images/images-user-'.$myInfo->id, $fullName);

            $allImages[] = Image::create([
                'user_id' => $myInfo->id,
                'name' => $fullName,
                'file_id' => $folderId
            ]);
        }

        return $allImages;
    }

    public function deletedImage($image_id)
    {
        $image = Image::find($image_id);

        if(!is_null($image)) {
            $image->delete();
            return $image;
        } else {
            return response()->json([
                "success" => false,
                "message" => "Image does not find"
            ]);
        }
    }

    public function likeImage($image_id)
    {
        $user_id = auth()->user()->id;
        $data = [
            "image_id" => $image_id,
            "user_id"  => $user_id,
        ];
        $like = Like::where($data)->first();

        if(is_null($like)) {
            try {
                $like = Like::create($data);
                Log::info("Image Like ".json_encode($like) );
                return response()->json([
                    "status" => 200
                ]);
            } catch (\Exception $e) {
                Log::error("Error like image ".$e->getMessage());
                return response()->json([
                    "status" => 400
                ], 400);
            }
        } else {
            try {
                Log::info("delete Image Like");
                $like->delete();
                return response()->json([
                    "status" => 204
                ]);
            } catch (\Exception $e) {
                Log::error("Error delete like image ".$e->getMessage());
                return response()->json([
                    "status" => 400
                ], 400);
            }
        }
    }

}
