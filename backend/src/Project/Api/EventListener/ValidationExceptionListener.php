<?php

namespace App\Project\Api\EventListener;

use App\Project\Api\Exception\ValidationException;
use App\Project\Api\Response\ApiResponse;
use App\Project\Api\Response\ResponseInterface;
use App\Project\Api\Utils\ResponseCodeFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\ConstraintViolationInterface;

class ValidationExceptionListener
{
    /**
     * @param ExceptionEvent $event
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();
        if ($exception instanceof ValidationException) {

            $response = new JsonResponse(
                (new ApiResponse())
                    ->setCode(ResponseInterface::RESPONSE_CODE_VALIDATE_ERROR)
                    ->setErrors($this->normalizeErrors($exception)),
                ResponseCodeFactory::getHttpCodeByResponseCode(ResponseInterface::RESPONSE_CODE_VALIDATE_ERROR)
            );

            $event->setResponse($response);
        }
    }

    /**
     * @param ValidationException $exception
     *
     * @return array
     */
    private function normalizeErrors(ValidationException $exception): array
    {
        $normalizedErrors = [];
        foreach ($exception->getErrors() as $error) {
            /** @var ConstraintViolationInterface $error */
            $propertyPath = trim($error->getPropertyPath(), '[]');
            $normalizedErrors[$propertyPath] = $error->getMessage();
        }

        return $normalizedErrors;
    }
}
