<?php

namespace App\Project\Api\Controller;

use App\Project\Api\Flow\FlowInterface;
use App\Project\Api\Response\ResponseInterface;
use App\Project\Api\Utils\ResponseCodeFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FlowController
{
    /**
     * @param FlowInterface $requestFlow
     * @param Request $request
     *
     * @return Response
     */
    public function index(FlowInterface $requestFlow, Request $request): Response
    {
        /** @var ResponseInterface $response */
        $response = $requestFlow->process($request);

        return new JsonResponse($response, ResponseCodeFactory::getHttpCodeByResponseCode($response->getCode()));
    }
}
