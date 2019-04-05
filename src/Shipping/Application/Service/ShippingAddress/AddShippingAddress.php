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
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressRepository;

class AddShippingAddress
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ShippingAddressRepository
     */
    private $shippingAddressRepository;

    /**
     * @var ShippingAddressDataTransformer
     */
    private $dataTransformer;

    public function __construct(
        ClientRepository $clientRepository,
        ShippingAddressRepository $shippingAddressRepository,
        ShippingAddressDataTransformer $dataTransformer
    ) {
        $this->clientRepository = $clientRepository;
        $this->shippingAddressRepository = $shippingAddressRepository;
        $this->dataTransformer = $dataTransformer;
    }

    public function run(ClientId $clientId, ShippingAddressParameters $shippingAddressParameters)
    {
        $client = $this->clientRepository->requireById($clientId);
        if ($client->isNextShippingAddressForsedBeDefault()) {
            $shippingAddressParameters = new ShippingAddressParameters(
                $shippingAddressParameters->getAddress(),
                true
            );
        }
        $client->checkThatShippingAddressIsAddable();
        $newShippingAddress = ShippingAddress::factory(
            $client,
            $shippingAddressParameters->getAddress(),
            $shippingAddressParameters->makeAsDefault()
        );

        if ($shippingAddressParameters->makeAsDefault()) {
            $this->adjustAllShippingAddressesDefaultStatuses($newShippingAddress);

            $shippingAddressCollection = $client->getShippingAddresses();
            $shippingAddressCollection->add($newShippingAddress);

            $this->shippingAddressRepository->saveSet($shippingAddressCollection);
        } else {
            $this->shippingAddressRepository->save($newShippingAddress);
        }
        $this->dataTransformer->write($newShippingAddress);
    }

    private function adjustAllShippingAddressesDefaultStatuses(ShippingAddress $shippingAddress)
    {
        foreach ($shippingAddress->getClient()->getShippingAddresses() as $clientShippingAddress) {
            if ($clientShippingAddress !== $shippingAddress) {
                $clientShippingAddress->makeNotDefault();
            }
        }
    }
}