<?php

namespace App\Project\Api\Response;

interface ResponseInterface
{
    /**
     * @var string
     */
    public const RESPONSE_CODE_SUCCESS = 'SUCCESS';

    /**
     * @var string
     */
    public const RESPONSE_CODE_VALIDATE_ERROR = 'VALIDATE_ERROR';

    /**
     * @var string
     */
    public const RESPONSE_CODE_INTERNAL_ERROR = 'INTERNAL_ERROR';

    /**
     * @var string
     */
    public const RESPONSE_CODE_NOT_FOUND = 'NOT_FOUND';

    /**
     * @var string
     */
    public const RESPONSE_CODE_NO_CONTENT = 'NO_CONTENT';

    /**
     * @var string
     */
    public const RESPONSE_CODE_CREATED = 'CREATED';

    /**
     * @return string
     */
    public function getCode(): string;


    /**
     * @param string $code
     *
     * @return ResponseInterface
     */
    public function setCode(string $code): ResponseInterface;

    /**
     * @param mixed $data
     *
     * @return ResponseInterface
     */
    public function setData($data): ResponseInterface;

    /**
     * @param string|null $message
     *
     * @return ResponseInterface
     */
    public function setMessage(?string $message): ResponseInterface;

    /**
     * @param string[]|null $errors
     *
     * @return ResponseInterface
     */
    public function setErrors(?array $errors): ResponseInterface;
}
