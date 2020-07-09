<?php

namespace I9w3b\AlertMessage;

use Illuminate\Support\Facades\Facade;

class AlertMessageFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'alert-message';
    }
}
