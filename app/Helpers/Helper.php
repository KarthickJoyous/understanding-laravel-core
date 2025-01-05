<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public function __construct(private $id) {}

    public function generateUUID()
    {

        return Str::uuid();
    }

    public function nowFormatted($format)
    {

        return now()->format($format);
    }
}
