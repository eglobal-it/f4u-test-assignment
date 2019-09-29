<?php

namespace App\Project\Api\Utils;

use App\Project\Api\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class ResponseCodeFactory
{
    /**
     * @param string $code
     *
     * @return int
     */
    public static function getHttpCodeByResponseCode(string $code): int
    {
        switch ($code) {
            case ResponseInterface::RESPONSE_CODE_NOT_FOUND:
                $httpCode = Response::HTTP_NOT_FOUND; break;
            case ResponseInterface::RESPONSE_CODE_VALIDATE_ERROR:
                $httpCode = Response::HTTP_BAD_REQUEST; break;
            case ResponseInterface::RESPONSE_CODE_NO_CONTENT:
                $httpCode = Response::HTTP_NO_CONTENT; break;
            case ResponseInterface::RESPONSE_CODE_CREATED:
                $httpCode = Response::HTTP_CREATED; break;
            case ResponseInterface::RESPONSE_CODE_SUCCESS:
                $httpCode = Response::HTTP_OK; break;
            case ResponseInterface::RESPONSE_CODE_INTERNAL_ERROR:
            default:
                $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $httpCode;
    }
}
