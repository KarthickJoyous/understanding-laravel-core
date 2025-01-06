<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /** @use HasFactory<\Database\Factories\OwnerFactory> */
    use HasFactory;

    public function car()
    {
        return $this->belongsTo(Mechanic::class)->withDefault();
    }

    public function carMechanic()
    {
        return $this->hasOne(Mechanic::class, Car::class)->withDefault();
    }
}
