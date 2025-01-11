<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    /** @use HasFactory<\Database\Factories\GarageFactory> */
    use HasFactory;

    protected $guarded = ['garage_id'];

    protected $primaryKey = 'garage_id';

    public function buses()
    {
        return $this->hasMany(Bus::class, 'garage_id', 'garage_id');
    }

    public function securities()
    {
        return $this->hasManyThrough(Security::class, Bus::class, 'garage_id', 'bus_id');
    }
}
