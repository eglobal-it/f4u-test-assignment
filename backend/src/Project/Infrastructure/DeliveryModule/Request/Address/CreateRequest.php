<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Address;

use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\Common\Request\Traits\ClientId;
use App\Project\Infrastructure\Common\Request\ValidatedInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Traits\AddressFields;

class CreateRequest implements RequestInterface, ValidatedInterface, CreateAddressRequestInterface
{
    use AddressFields, ClientId;
}
