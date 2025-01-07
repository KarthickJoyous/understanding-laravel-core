<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        // return Media::with(['mediable'])->get();

        return Media::query()
            ->with(['mediable' => function ($morphTo) {
                $morphTo->morphWithCount([
                    Post::class => ['comments'],
                    Comment::class => ['post'],
                ]);
            }])
            // ->whereHasMorph('mediable', Post::class, function ($query) {
            //     $query->where('post', "LIKE", "%i%");
            // })
            ->get();
    }

    public function show(Media $medium)
    {
        return $medium
            ->load(['mediable'])
            ->loadMorphCount('mediable', [
                Post::class => ['comments'],
                Comment::class => ['post']
            ]);
    }
}
