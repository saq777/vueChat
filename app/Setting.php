<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id',
        'notification',
        'status',
        'phone_number',
        'phone_verification_code',
        'phone_verification_is',
    ];
}
