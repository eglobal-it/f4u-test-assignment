<?php

namespace App\Project\Context\UserModule;

use App\Project\Context\UserModule\Client\ClientServiceInterface;
use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;

class UserContract implements UserContractInterface
{
    /**
     * @var ClientServiceInterface
     */
    private $clientService;

    /**
     * @param ClientServiceInterface $clientService
     */
    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @inheritDoc
     */
    public function getClientById(int $clientId): ClientEntityInterface
    {
        return $this->clientService->getClientById($clientId);
    }

    /**
     * @return ClientEntityInterface[]
     */
    public function findClients(): array
    {
        return $this->clientService->findClients();
    }

    /**
     * @inheritDoc
     */
    public function transformClientToArray(ClientEntityInterface $clientEntity): array
    {
        return $this->clientService->transformClientToArray($clientEntity);
    }
}
