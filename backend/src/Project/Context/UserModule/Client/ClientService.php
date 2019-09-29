<?php

namespace App\Project\Context\UserModule\Client;

use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use App\Project\Context\UserModule\Client\Repository\ClientRepositoryInterface;
use App\Project\Context\UserModule\Client\Transformer\ClientTransformerInterface;

class ClientService implements ClientServiceInterface
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * @var ClientTransformerInterface
     */
    private $clientTransformer;

    /**
     * @param ClientRepositoryInterface $clientRepository
     * @param ClientTransformerInterface $clientTransformer
     */
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        ClientTransformerInterface $clientTransformer
    ) {
        $this->clientRepository = $clientRepository;
        $this->clientTransformer = $clientTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getClientById(int $clientId): ClientEntityInterface
    {
        return $this->clientRepository->findClientById($clientId);
    }

    /**
     * @inheritDoc
     */
    public function findClients(): array
    {
        return $this->clientRepository->findClients();
    }

    /**
     * @inheritDoc
     */
    public function transformClientToArray(ClientEntityInterface $clientEntity): array
    {
        return $this->clientTransformer->transform($clientEntity);
    }
}
