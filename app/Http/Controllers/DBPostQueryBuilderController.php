<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DBPostQueryBuilderController extends Controller
{
    public function index()
    {   
        // Users with / without post 
        return DB::table('users')->select('users.id as user_id', 'users.name as name', 'posts.id as post_id', 'posts.post as post')->leftJoin('posts', 'posts.user_id', '=', 'users.id')->orderByDesc('posts.user_id')->get();
        return DB::select("select users.id as user_id, users.name, posts.id as post_id, posts.post from users left join posts on users.id = posts.user_id order by posts.user_id desc");
        return User::with(['posts:id,user_id,post'])->simplePaginate();

        // Users without post 

        return DB::table('users')->select('users.id as user_id', 'users.name as name', 'posts.id as post_id', 'posts.post as post')->leftJoin('posts', 'posts.user_id', '=', 'users.id')->whereNull('posts.post')->orderByDesc('posts.user_id')->get();
        return DB::select("select users.id as user_id, users.name, posts.id as post_id, posts.post from users left join posts on users.id = posts.user_id where posts.post is null order by posts.user_id desc");
        return User::doesnthave('posts')->simplePaginate();
    }
}
