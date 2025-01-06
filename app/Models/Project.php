<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }

    public function propertyBroker()
    {
        return $this->hasOneThrough(Broker::class, Property::class);
    }
}
