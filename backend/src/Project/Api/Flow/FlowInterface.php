<?php

declare(strict_types=1);

namespace App\Project\Api\Flow;

use App\Project\Api\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;

interface FlowInterface
{
    /**
     * @param Request $request
     *
     * @return ResponseInterface
     */
    public function process(Request $request): ResponseInterface;
}
