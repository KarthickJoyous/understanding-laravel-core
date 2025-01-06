<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index()
    {
        return Mechanic::query()
            ->with([
                'car:id,mechanic_id,model',
                'carOwner'
                //'car.owner:id,car_id,name'
            ])
            ->get();
    }

    public function show(Mechanic $mechanic)
    {
        return $mechanic;
    }
}
