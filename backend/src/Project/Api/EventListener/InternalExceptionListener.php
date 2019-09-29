<?php

namespace App\Project\Api\EventListener;

use App\Project\Api\Response\ApiResponse;
use App\Project\Api\Response\ResponseInterface;
use App\Project\Api\Utils\ResponseCodeFactory;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class InternalExceptionListener
{
    /**
     * @param ExceptionEvent $event
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();
        if ($exception instanceof Exception) {
            $response = new JsonResponse(
                (new ApiResponse())
                    ->setCode(ResponseInterface::RESPONSE_CODE_INTERNAL_ERROR)
                    ->setMessage($exception->getMessage()),
            $exception->getCode() ?:
                    ResponseCodeFactory::getHttpCodeByResponseCode(ResponseInterface::RESPONSE_CODE_INTERNAL_ERROR)
            );

            $event->setResponse($response);
        }
    }
}
