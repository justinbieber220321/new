<?php

namespace App\Contracts\Facades;

use Illuminate\Support\Facades\Facade;

class ChannelLog extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chanellog';
    }
}