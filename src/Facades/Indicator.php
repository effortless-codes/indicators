<?php

namespace Winata\Core\Indicator\Facades;

use Illuminate\Support\Facades\Facade;

class Indicator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'indicator';
    }
}
