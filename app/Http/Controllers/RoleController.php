<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::query()
            ->with([
                'users'
            ])
            ->get();
    }

    public function show(Role $role)
    {
        return $role->load(['users'])->loadCount(['users']);
    }
}
