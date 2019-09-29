<?php

namespace App\Project\Infrastructure\Common\Stage;

use App\Project\Infrastructure\Common\Transformer\TransformerInterface;
use League\Pipeline\StageInterface;

class TransformToArray implements StageInterface
{
    /**
     * @var TransformerInterface
     */
    private $transformer;

    /**
     * @param TransformerInterface $transformer
     */
    public function __construct(TransformerInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @inheritDoc
     *
     * @param mixed $payload
     *
     * @return array
     */
    public function __invoke($payload): array
    {
        return $this->transformer->transform($payload);
    }
}
