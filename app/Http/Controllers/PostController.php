<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::query()
            ->withCount(['comments'])
            ->with([
                'user:id,name',
                'comments:id,post_id,user_id,comment',
                'comments.user:id,name'
            ])
            ->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post->loadCount(['comments'])
            ->load([
                'user:id,name',
                'comments:id,post_id,user_id,comment',
                'comments.user:id,name'
            ]);
    }
}
