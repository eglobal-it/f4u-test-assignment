<?php

namespace App\Project\Api\RequestTransformer;

use App\Project\Infrastructure\Common\Request\RequestInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

interface RequestTransformerInterface
{
    /**
     * @param SymfonyRequest $request
     *
     * @return RequestInterface
     */
    public function transform(SymfonyRequest $request): RequestInterface;
}
