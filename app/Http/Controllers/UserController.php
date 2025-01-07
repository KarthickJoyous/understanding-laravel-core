<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return $user;
    }

    public function wallet(User $user)
    {
        return $user->wallet;
    }

    public function roles(User $user)
    {
        return $user->load(['roles:id,name']);

        return $user
            ->load(['roles' => function ($query) {
                $query->select('roles.id', 'roles.name')->where('roles.name', "LIKE", "%ic%");
            }]);
    }
}
