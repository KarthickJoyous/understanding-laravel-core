<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::query()
            ->with([
                'user:id,name',
                'post:id,user_id,post',
                'post.user:id,name',
                'postUser' => function ($query) {
                    $query->select('users.id', 'users.name');
                }
            ])
            ->get();
    }

    public function show(Comment $comment)
    {
        return $comment->load([
            'user:id,name',
            // 'post:id,post',
            // 'post.user:id,name',
            'postUser' => function ($query) {
                $query->select('users.id', 'users.name');
            }
        ]);
    }

    public function media(Comment $comment)
    {
        return $comment->loadCount(['media'])->load(['media:id,media,mediable_id,mediable_type']);
    }
}
