<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        "from_id",
        "to_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "to_id", "id");
    }

    public function story()
    {
        return $this->hasMany(Story::class, "user_id", "to_id");
    }
}
