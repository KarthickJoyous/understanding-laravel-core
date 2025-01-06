<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    /** @use HasFactory<\Database\Factories\BrokerFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function property()
    {
        return $this->belongsTo(Property::class)->withDefault();
    }

    public function propertyProject()
    {
        return $this->hasOneThrough(Project::class, Property::class);
    }
}
