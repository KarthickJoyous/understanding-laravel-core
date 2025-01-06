<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class)->withDefault();
    }

    public function owner()
    {
        return $this->hasOne(Owner::class)->withDefault();
    }
}
