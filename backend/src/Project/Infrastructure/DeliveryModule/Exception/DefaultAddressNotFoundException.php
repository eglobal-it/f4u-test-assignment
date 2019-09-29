<?php

namespace App\Project\Infrastructure\DeliveryModule\Exception;

use Exception;

class DefaultAddressNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Default Address Not Found';
}
