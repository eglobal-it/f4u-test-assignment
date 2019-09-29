<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Address;

use App\Project\Infrastructure\Common\Request\ClientIdRequestInterface;
use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\Common\Request\Traits\ClientId;
use App\Project\Infrastructure\Common\Request\ValidatedInterface;

class ListingRequest implements RequestInterface, ValidatedInterface, ClientIdRequestInterface
{
    use ClientId;
}
