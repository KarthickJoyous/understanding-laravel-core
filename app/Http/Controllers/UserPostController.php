<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        // $user->loadCount(['posts']);

        // return [
        //     'user' => $user,
        //     'posts' => $user->posts()->select('id', 'user_id', 'post')->withCount(['comments'])->with(['comments:id,post_id,comment'])->get()
        // ];

        return User::query()
            ->withCount(['posts'])
            ->with([
                'posts' => function ($query) {
                    $query->select('id', 'user_id', 'post')
                        ->withCount('comments')
                        ->with(['comments:id,post_id,comment']);
                },
            ])
            ->firstWhere(['id' => $user->id]);
    }

    public function show(User $user, Post $post)
    {
        return $post;
    }
}
