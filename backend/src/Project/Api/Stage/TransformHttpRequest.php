<?php

declare(strict_types=1);

namespace App\Project\Api\Stage;

use App\Project\Api\RequestTransformer\RequestTransformerInterface;
use App\Project\Infrastructure\Common\Request\RequestInterface;
use League\Pipeline\StageInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TransformHttpRequest implements StageInterface
{
    /**
     * @var RequestTransformerInterface
     */
    private $symfonyRequestTransformer;

    /**
     * @param RequestTransformerInterface $symfonyRequestTransformer
     */
    public function __construct(RequestTransformerInterface $symfonyRequestTransformer)
    {
        $this->symfonyRequestTransformer = $symfonyRequestTransformer;
    }

    /**
     * @param SymfonyRequest $payload
     *
     * @return RequestInterface
     */
    public function __invoke($payload): RequestInterface
    {
        return $this->symfonyRequestTransformer->transform($payload);
    }
}
