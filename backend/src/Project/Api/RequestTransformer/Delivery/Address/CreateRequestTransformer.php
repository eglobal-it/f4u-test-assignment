<?php

namespace App\Project\Api\RequestTransformer\Delivery\Address;

use App\Project\Api\RequestTransformer\RequestTransformerInterface;
use App\Project\Infrastructure\Common\Request\RequestInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Address\CreateRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class CreateRequestTransformer implements RequestTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(SymfonyRequest $request): RequestInterface
    {
        return (new CreateRequest())
            ->setClientId($request->attributes->getInt('clientId'))
            ->setZipCode($request->request->get('zip_code'))
            ->setCountry($request->request->get('country'))
            ->setCity($request->request->get('city'))
            ->setStreet($request->request->get('street'));
    }
}
