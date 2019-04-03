<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:13
 */

namespace F4u\Shipping\Domain\Service\ShippingAddress;

use F4u\Shipping\Domain\Model\Client\Client;
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

    public function __construct(
        ClientRepository $clientRepository,
        ShippingAddressRepository $shippingAddressRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->shippingAddressRepository = $shippingAddressRepository;
    }

    public function run(ClientId $clientId, ShippingAddressParameters $shippingAddressParameters)
    {
        $client = $this->clientRepository->byId($clientId);
        if (!$client instanceof Client) {
            throw new \RuntimeException('Not found client with given identifier');
        }
        switch ($client->getShippingAddresses()->count()) {
            case 0:
                $shippingAddressParameters = new ShippingAddressParameters(
                    $shippingAddressParameters->getAddress(),
                    true
                );
                break;
            case 3:
                throw new \OverflowException('Given client already has maximum (3) shipping addresses');
                break;
        }
        $newShippingAddress = ShippingAddress::factory($client, $shippingAddressParameters);

        if ($shippingAddressParameters->makeAsDefault()) {
            $this->adjustAllShippingAddressesDefaultStatuses($newShippingAddress);

            $shippingAddressCollection = $client->getShippingAddresses();
            $shippingAddressCollection->add($newShippingAddress);

            $this->shippingAddressRepository->saveSet($shippingAddressCollection);
        } else {
            $this->shippingAddressRepository->save($newShippingAddress);
        }
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