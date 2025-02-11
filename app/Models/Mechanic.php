<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    /** @use HasFactory<\Database\Factories\MechanicFactory> */
    use HasFactory;

    public function car()
    {
        return $this->hasOne(Car::class)->withDefault();
    }

    public function carOwner()
    {
        // return $this->hasOneThrough(Owner::class, Car::class)->withDefault();
        return $this->hasOneThrough(Owner::class, Car::class, 'mechanic_id', 'car_id')->withDefault();
    }
}
