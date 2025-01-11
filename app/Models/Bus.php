<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    /** @use HasFactory<\Database\Factories\BusFactory> */
    use HasFactory;

    protected $guarded = ['bus_id'];

    protected $primaryKey = 'bus_id';

    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'garage_id')->withDefault();
    }

    public function security()
    {
        return $this->hasOne(Security::class, 'bus_id', 'bus_id');
    }
}
