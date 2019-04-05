<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:13
 */

namespace F4u\Shipping\Application\Service\ShippingAddress;

use F4u\Shipping\Application\Service\ShippingAddress\DataTransformer\ShippingAddressDataTransformer;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\Client\ClientRepository;

class ListShippingAddress
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ShippingAddressDataTransformer
     */
    private $dataTransformer;

    public function __construct(ClientRepository $clientRepository, ShippingAddressDataTransformer $dataTransformer)
    {
        $this->clientRepository = $clientRepository;
        $this->dataTransformer = $dataTransformer;
    }

    public function run(ClientId $clientId)
    {
        $client = $this->clientRepository->requireById($clientId);
        $this->dataTransformer->writeCollection($client->getShippingAddresses());
    }
}