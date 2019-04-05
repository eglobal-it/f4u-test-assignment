<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 02/04/2019
 * Time: 02:18
 */

namespace F4u\Shipping\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use F4u\Shipping\Domain\Model\Client\Client;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\Client\ClientRepository;

class DoctrineClientRepository implements ClientRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Client $client)
    {
        $this->entityManager->persist($client);
        $this->entityManager->flush();
    }

    public function byId(ClientId $clientId)
    {
        return $this->entityManager->find(Client::class, $clientId);
    }

    public function requireById(ClientId $clientId): Client
    {
        $client = $this->byId($clientId);
        if (!$client instanceof Client) {
            throw new \RuntimeException('Not found client with given identifier');
        }
        return $client;
    }
}