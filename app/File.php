<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "files";

    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'file_id', 'id');
    }
}
