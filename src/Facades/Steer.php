<?php

namespace FredBradley\PhpSteerApi\Facades;

class Steer extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'steerapi';
    }
}
