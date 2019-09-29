<?php

namespace App\Project\Infrastructure\UserModule\Stage\Client;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Infrastructure\UserModule\Request\Client\ClientIdRequestInterface;

class GetClient extends BaseClientStage
{
    /**
     * @inheritDoc
     *
     * @param ClientIdRequestInterface $payload
     *
     * @return ClientEntityInterface
     */
    public function __invoke($payload): ClientEntityInterface
    {
        return $this->getClientById($payload->getClientId());
    }

    /**
     * @param int $id
     *
     * @return ClientEntityInterface
     */
    private function getClientById(int $id): ClientEntityInterface
    {
        return $this->getUserContract()->getClientById($id);
    }
}
