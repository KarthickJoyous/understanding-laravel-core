<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function join()
    {
        return DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id as post_id', 'posts.post as post', 'users.id as user_id', 'users.name as user')
            ->paginate(pageName: 'current');
    }

    public function left()
    {
        return DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->when(request('deleted_users'), function ($query) {
                $query->whereNull('users.id');
            })
            ->select('posts.id as post_id', 'posts.post as post', 'users.id as user_id', 'users.name as user')
            ->paginate(pageName: 'current');
    }

    public function right()
    {
        return DB::table('posts')
            ->rightjoin('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id as post_id', 'posts.post as post', 'users.id as user_id', 'users.name as user')
            ->paginate(pageName: 'current');
    }

    public function self()
    {

        return DB::table('posts as p1')
            // ->leftjoin('posts as p2', DB::raw("LENGTH(p1.post)"), '>', DB::raw("LENGTH(p2.post)"))
            ->leftjoin('posts as p2', 'p1.id', '!=', 'p2.id')
            ->select(
                'p1.id as p1_post_id',
                'p1.post as p1_post',
                DB::raw("LENGTH(p1.post) as p1_post_LENGTH"),
                'p2.id as p2_post_id',
                'p2.post as p2_post',
                DB::raw("LENGTH(p2.post) as p2_post_LENGTH"),
                DB::raw(
                    "CASE 
                        WHEN LENGTH(p1.post) > LENGTH(p2.post) THEN 'p1 is winner'
                        WHEN LENGTH(p2.post) > LENGTH(p1.post) THEN 'p2 is winner'
                        ELSE 'TIE'
                    END AS Result"
                )
            )
            //->orderBy("Result", "DESC")
            ->orderByRaw("FIND_IN_SET(Result, 'p2 is winner,TIE,p1 is winner')")
            ->paginate(500);
    }

    public function cross()
    {
        return DB::table('posts as p1')
            ->crossjoin('posts as p2')
            ->whereRaw('p1.id != p2.id')
            ->select(
                'p1.id as p1_post_id',
                'p1.post as p1_post',
                DB::raw("LENGTH(p1.post) as p1_post_LENGTH"),
                'p2.id as p2_post_id',
                'p2.post as p2_post',
                DB::raw("LENGTH(p2.post) as p2_post_LENGTH"),
                DB::raw(
                    "CASE 
                        WHEN LENGTH(p1.post) > LENGTH(p2.post) THEN 'p1 is winner'
                        WHEN LENGTH(p2.post) > LENGTH(p1.post) THEN 'p2 is winner'
                        ELSE 'TIE'
                    END AS Result"
                )
            )
            ->orderByRaw("FIND_IN_SET(Result, 'p2 is winner,TIE,p1 is winner')")
            ->paginate(500);
    }

    public function full()
    {

        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', 'posts.user_id')
            ->select('posts.id as post_id', 'posts.post as post', 'users.id as user_id', 'users.name as user');


        return DB::table('users')
            ->rightJoin('posts', 'users.id', 'posts.user_id')
            ->select('posts.id as post_id', 'posts.post as post', 'users.id as user_id', 'users.name as user')
            ->union($users)
            ->paginate(500);
    }
}
