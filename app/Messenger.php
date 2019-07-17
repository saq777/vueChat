<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    protected $table = "Messenger";

    protected $fillable = ['from_id', 'to_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
