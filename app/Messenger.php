<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    protected $table = "Messenger";

    protected $fillable = ['from_id', 'to_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
}
