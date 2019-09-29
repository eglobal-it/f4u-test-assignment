<?php

namespace App\Project\Context\UserModule\Client;

use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;

interface ClientServiceInterface
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
     * @param ClientEntityInterface $clientEntity
     *
     * @return array
     */
    public function transformClientToArray(ClientEntityInterface $clientEntity): array;
}
