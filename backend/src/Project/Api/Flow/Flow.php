<?php

declare(strict_types=1);

namespace App\Project\Api\Flow;

use App\Project\Api\Response\ResponseInterface;
use League\Pipeline\PipelineInterface;
use Symfony\Component\HttpFoundation\Request;

class Flow implements FlowInterface
{
    /**
     * @var PipelineInterface
     */
    private $integration;

    /**
     * @param PipelineInterface $integration
     */
    public function __construct(PipelineInterface $integration)
    {
        $this->integration = $integration;
    }

    /**
     * @inheritdoc
     */
    public function process(Request $request): ResponseInterface
    {
        return ($this->integration)($request);
    }
}
