<?php

namespace App\Project\Api\EventListener;

use App\Project\Api\Response\ApiResponse;
use App\Project\Api\Response\ResponseInterface;
use App\Project\Api\Utils\ResponseCodeFactory;
use App\Project\Context\CommonInterfaces\Exception\EntityNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class EntityNotFoundExceptionListener
{
    /**
     * @param ExceptionEvent $event
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();
        if ($exception instanceof EntityNotFoundException) {

            $response = new JsonResponse(
                (new ApiResponse())
                    ->setCode(ResponseInterface::RESPONSE_CODE_NOT_FOUND)
                    ->setMessage($exception->getMessage()),
                ResponseCodeFactory::getHttpCodeByResponseCode(ResponseInterface::RESPONSE_CODE_NOT_FOUND)
            );

            $event->setResponse($response);
        }
    }
}
