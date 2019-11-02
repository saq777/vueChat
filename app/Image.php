<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";

    protected $fillable = ['user_id', 'name', 'file_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
