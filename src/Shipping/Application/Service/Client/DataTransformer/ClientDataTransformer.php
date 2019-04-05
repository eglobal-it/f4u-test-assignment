<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 22:26
 */
namespace F4u\Shipping\Application\Service\Client\DataTransformer;

use F4u\Shipping\Domain\Model\Client\Client;

interface ClientDataTransformer
{
    public function write(Client $client);

    public function read();
}