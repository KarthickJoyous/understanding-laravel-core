<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /** @use HasFactory<\Database\Factories\WalletFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'unique_id';
    }

    public function user()
    {
        return $this->hasOne(User::class)->withDefault();
    }

    protected static function booted()
    {

        static::creating(function (Wallet $wallet) {
            $wallet->unique_id = uniqid();
        });

        static::created(function (Wallet $wallet) {
            $wallet->unique_id = uniqid();
        });
    }
}
