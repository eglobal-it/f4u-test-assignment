<?php

namespace App\Project\Infrastructure\UserModule\Repository;

use App\Project\Context\CommonInterfaces\Exception\EntityNotFoundException;
use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use App\Project\Context\UserModule\Client\Repository\ClientRepositoryInterface;
use App\Project\Infrastructure\Common\Repository\EntityRepository;

class ClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    /**
     * @inheritDoc
     * @throws EntityNotFoundException
     */
    public function findClientById(int $id): ClientEntityInterface
    {
        $client = $this->findOneBy(['id' => $id]);

        if ($client instanceof ClientEntityInterface) {
            return $client;
        }

        throw (new EntityNotFoundException())->setClass(ClientEntityInterface::class);
    }

    /**
     * @inheritDoc
     */
    public function findClients(): array
    {
        return $this->findAll();
    }
}
