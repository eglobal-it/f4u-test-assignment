<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:16
 */

namespace F4u\Shipping\Domain\Model\Client;


interface ClientRepository
{
    /**
     * @param Client $client
     *
     * @return mixed
     */
    public function save(Client $client);

    /**
     * @param ClientId $clientId
     *
     * @return mixed
     */
    public function byId(ClientId $clientId);

    /**
     * @param ClientId $clientId
     *
     * @return Client
     */
    public function requireById(ClientId $clientId): Client;
}