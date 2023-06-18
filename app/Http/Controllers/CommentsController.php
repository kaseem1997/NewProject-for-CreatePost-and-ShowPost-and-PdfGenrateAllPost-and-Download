<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->body = $request->input('body');
        $comment->save();

        return response()->json(['message' => 'Comment added successfully'], 201);
    }
}
