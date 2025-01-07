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
                //'car:id,mechanic_id,model',
                // 'carOwner:id,name', -- Will give error
                'carOwner' => function ($query) {
                    $query->select('owners.id', 'owners.name');
                }
                //'car.owner:id,car_id,name'
            ])
            ->get();
    }

    public function show(Mechanic $mechanic)
    {
        return $mechanic;
    }
}
