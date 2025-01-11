<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    /** @use HasFactory<\Database\Factories\SecurityFactory> */
    use HasFactory;

    protected $guarded = ['security_id'];

    protected $primaryKey = 'security_id';

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'bus_id');
    }

    public function garage()
    {
        return $this->hasOneThrough(Garage::class, Bus::class, 'bus_id', 'garage_id', 'bus_id', 'garage_id');
    }
}
