<?php

namespace App\Http\Controllers;

use App\Models\Garage;

class GarageController extends Controller
{
    public function index()
    {
        return Garage::with([
            'buses',
            'buses.security',
            'securities'
        ])->get();
    }

    public function show(Garage $garage)
    {
        return $garage->load([
            'buses',
            'buses.security',
            'securities'
        ]);
    }
}
