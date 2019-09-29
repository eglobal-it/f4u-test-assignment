<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Address;

use App\Project\Infrastructure\Common\Request\ClientIdRequestInterface;

interface CreateAddressRequestInterface extends ClientIdRequestInterface, AddressFieldsRequestInterface
{
}
