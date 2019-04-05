<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 22:32
 */

namespace F4u\Shipping\Application\Service\Client\DataTransformer;


use F4u\Shipping\Domain\Model\Client\Client;

class JsonClientDataTransformer implements ClientDataTransformer
{
    /**
     * @var array
     */
    private $data;

    public function write(Client $client)
    {
        $this->data = json_encode($client);
    }

    /**
     * @return string
     */
    public function read()
    {
        return $this->data;
    }
}
