<?php

namespace App\Project\Api\Response;

use JsonSerializable;

class ApiResponse implements ResponseInterface, JsonSerializable
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var string[]|null
     */
    private $errors;

    /**
     * @inheritDoc
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function setCode(string $code): ResponseInterface
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setData($data): ResponseInterface
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMessage(?string $message): ResponseInterface
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setErrors(?array $errors): ResponseInterface
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors
        ];
    }
}
