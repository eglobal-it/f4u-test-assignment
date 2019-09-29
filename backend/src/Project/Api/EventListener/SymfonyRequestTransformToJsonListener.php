<?php

namespace App\Project\Api\EventListener;

use App\Project\Api\Exception\FailParseJsonRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SymfonyRequestTransformToJsonListener
{
    /**
     * {@inheritdoc}
     * @throws FailParseJsonRequestException
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if ($this->isAvailable($request)) {
            $this->transform($request);
        }
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function isAvailable(Request $request): bool
    {
        return 'json' === $request->getContentType() && $request->getContent();
    }

    /**
     * @param Request $request
     *
     * @return void
     * @throws FailParseJsonRequestException
     */
    private function transform(Request $request): void
    {
        $data = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new FailParseJsonRequestException("Fail parse \"{$request->getContent()}\"");
        }
        if (is_array($data)) {
            $request->request->replace($data);
        }
    }
}
