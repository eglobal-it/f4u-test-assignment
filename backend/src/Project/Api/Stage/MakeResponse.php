<?php

namespace App\Project\Api\Stage;

use App\Project\Api\Response\ApiResponse;
use App\Project\Api\Response\ResponseInterface;
use League\Pipeline\StageInterface;

class MakeResponse implements StageInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @inheritDoc
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function __invoke($payload): ResponseInterface
    {
        return (new ApiResponse())
            ->setCode($this->code)
            ->setData($payload);
    }
}
