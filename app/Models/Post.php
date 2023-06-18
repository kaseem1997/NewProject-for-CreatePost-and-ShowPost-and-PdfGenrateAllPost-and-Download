<?php

namespace App\Models;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    protected $fillable = [ 'id', 'title', 'body', 'like_count', 'dislike_count', 'user_id', ];
}
