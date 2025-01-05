<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HelperFacade extends Facade
{
    /**
     * @method static generateUUID()
     * @method static nowFormatted()
     */
    protected static function getFacadeAccessor()
    {

        return 'helper';
    }
}
