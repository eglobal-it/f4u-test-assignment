<?php

namespace App\Project\Infrastructure\UserModule\Request\Client;

use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\Common\Request\Traits\ClientId;
use App\Project\Infrastructure\Common\Request\ValidatedInterface;

class ReadRequest implements RequestInterface, ValidatedInterface, ClientIdRequestInterface
{
    use ClientId;
}
