<?php

namespace App\Project\Context\UserModule;

use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;

interface UserContractInterface
{
    /**
     * @param int $clientId
     *
     * @return ClientEntityInterface
     */
    public function getClientById(int $clientId): ClientEntityInterface;

    /**
     * @return ClientEntityInterface[]
     */
    public function findClients(): array;

    /**
     * @inheritDoc
     */
    public function transformClientToArray(ClientEntityInterface $clientEntity): array;
}
