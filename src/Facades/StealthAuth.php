<?php

namespace StealthAuth\Facades;

use Illuminate\Support\Facades\Facade;

class StealthAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'stealth-auth';
    }
}
