<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $settings = Setting::where("user_id", $user_id)->first();

        return view("settings.index", compact('settings'));
    }

    public function notification()
    {
        $user_id = auth()->user()->id;
        $settings = Setting::where("user_id", $user_id)->first();
        $settings->notification = !$settings->notification;
        $settings->save();

        return response()->json([ "status" => $settings->notification]);

    }
}
