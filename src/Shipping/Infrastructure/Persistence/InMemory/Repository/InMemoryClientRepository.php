<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 05/04/2019
 * Time: 09:05
 */
namespace F4u\Shipping\Infrastructure\Persistence\InMemory\Repository;

use F4u\Shipping\Domain\Model\Client\Client;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\Client\ClientRepository;

class InMemoryClientRepository implements ClientRepository
{
    private $clients = [];

    public function save(Client $client)
    {
        $this->clients[(string) $client->getClientId()] = $client;
    }

    public function byId(ClientId $clientId)
    {
        if (isset($this->clients[(string) $clientId])) {
            return $this->clients[(string) $clientId];
        }
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