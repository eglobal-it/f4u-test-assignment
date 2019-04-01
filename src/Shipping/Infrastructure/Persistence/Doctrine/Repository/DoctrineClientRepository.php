<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 02/04/2019
 * Time: 02:18
 */

namespace F4u\Shipping\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use F4u\Shipping\Domain\Model\Client\Client;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\Client\ClientRepository;

class DoctrineClientRepository extends EntityRepository implements ClientRepository
{
    public function save(Client $client)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($client);
        $entityManager->flush();
    }

    public function byId(ClientId $clientId)
    {
        return $this->find($clientId);
    }
}