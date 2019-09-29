<?php

namespace App\Project\Api\RequestTransformer\Delivery\Address;

use App\Project\Api\RequestTransformer\RequestTransformerInterface;
use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Address\ReadAndDeleteAndSetDefaultRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class ReadAndDeleteAndSetDefaultRequestTransformer implements RequestTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(SymfonyRequest $request): RequestInterface
    {
        return (new ReadAndDeleteAndSetDefaultRequest())
            ->setAddressId($request->attributes->getInt('addressId'));
    }
}
