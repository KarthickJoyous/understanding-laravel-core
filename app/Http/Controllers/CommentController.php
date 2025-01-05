<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::query()
            ->with(['post:id,user_id,post', 'user:id,name', 'post.user:id,name'])
            ->get();
    }

    public function show(Comment $comment)
    {
        return $comment->load(['post:id,post', 'user:id,name', 'post.user:id,name']);
    }
}
