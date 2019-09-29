<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Address;

use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\Common\Request\ValidatedInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Traits\AddressFields;
use App\Project\Infrastructure\DeliveryModule\Request\Traits\AddressId;

class UpdateRequest implements RequestInterface, ValidatedInterface, UpdateAddressRequestInterface
{
    use AddressFields, AddressId;
}
