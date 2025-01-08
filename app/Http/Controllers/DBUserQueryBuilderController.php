<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DBUserQueryBuilderController extends Controller
{
    public function index()
    {

        return view('db_query_builders.users.index', [
            'total_users' => DB::scalar('select COUNT(*) from users'),
            'users' => DB::select("select users.*, (select COUNT(*) from posts where users.id = posts.user_id) as total_posts from users order by id DESC")
        ]);
    }

    public function store(Request $request)
    {

        $values = $request->only(['name', 'email']) + ['password' => Hash::make($request->password)];

        DB::transaction(function () use ($values) {

            return DB::insert("insert into users(name, email, password) values(:name, :email, :password)", $values);
        });

        return to_route('query_builders.users.index')->with('flash_success', 'User Created.');
    }

    public function show($id)
    {

        return DB::select("select * from users where id = $id");

        // Binding, Named Binding :

        return DB::select("select * from users where id = ?", [$id]);
        return DB::select("select * from users where id = :id", ["id" => $id]);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            return DB::delete("delete from users where id = $id");

            // Binding, Named Binding :

            return DB::delete("delete from users where id = ?", [$id]);
            return DB::delete("delete from users where id = :id", ["id" => $id]);
        });

        return to_route('query_builders.users.index')->with('flash_success', "User Deleted.");
    }
}
