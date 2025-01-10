<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PaginateController extends Controller
{
    public function paginate()
    {
        return User::paginate(20, ['id', 'name'], 'current');
    }

    public function simplePaginate()
    {
        return User::simplePaginate(20, ['id', 'name'], 'current');
    }

    public function cursorPaginate()
    {
        return User::cursorPaginate(20, ['id', 'name'], 'current');
    }
}
