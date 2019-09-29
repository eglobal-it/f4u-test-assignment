<?php

namespace App\Project\Context\UserModule\Client\Repository;

use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;

interface ClientRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return ClientEntityInterface
     */
    public function findClientById(int $id): ClientEntityInterface;

    /**
     * @return ClientEntityInterface[]
     */
    public function findClients(): array;
}
