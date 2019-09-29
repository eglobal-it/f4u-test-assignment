<?php

namespace App\Project\Api\RequestTransformer\Delivery\Address;

use App\Project\Api\RequestTransformer\RequestTransformerInterface;
use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Address\ListingRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class ListingAndGetDefaultRequestTransformer implements RequestTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(SymfonyRequest $request): RequestInterface
    {
        return (new ListingRequest())
            ->setClientId($request->attributes->getInt('clientId'));
    }
}
