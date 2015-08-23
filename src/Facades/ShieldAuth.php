<?php namespace Cristabel\Shield\Facades;

use Illuminate\Support\Facades\Facade;

class ShieldAuth extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'shieldauth';
    }

}
