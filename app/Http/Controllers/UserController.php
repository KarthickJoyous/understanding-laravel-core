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
}
