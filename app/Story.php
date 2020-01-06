<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        "user_id",
        "image",
        "title",
        "description",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
