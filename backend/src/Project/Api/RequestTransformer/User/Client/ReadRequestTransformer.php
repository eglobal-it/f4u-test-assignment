<?php

namespace App\Project\Api\RequestTransformer\User\Client;

use App\Project\Api\RequestTransformer\RequestTransformerInterface;
use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\UserModule\Request\Client\ReadRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class ReadRequestTransformer implements RequestTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(SymfonyRequest $request): RequestInterface
    {
        return (new ReadRequest())
            ->setClientId($request->attributes->getInt('clientId'));
    }
}
