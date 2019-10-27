<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Auth;

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

}
