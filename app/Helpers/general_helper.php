<?php


use App\Setting;

if(! function_exists("sendMail")) {
    function checkMail($user_id, $notification = null)
    {
        if($notification == 1) {
            return true;
        } else {
            $notice = Setting::select("notification")->where('user_id', $user_id)->first();
            if($notice->notification == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
}
