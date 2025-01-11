<?php

namespace App\Http\Controllers;

use App\Models\Security;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function index()
    {
        return Security::with([
            'bus',
            'bus.garage',
            'garage'
        ])->get();
    }

    public function show(Security $security)
    {
        return $security->load([
            'bus',
            'bus.garage',
            'garage'
        ]);
    }
}
