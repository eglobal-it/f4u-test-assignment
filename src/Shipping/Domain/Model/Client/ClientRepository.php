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
    public function save(Client $client);

    public function byId(ClientId $clientId);
}