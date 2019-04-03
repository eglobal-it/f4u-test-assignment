<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:02
 */

namespace F4u\Shipping\Domain\Model\ShippingAddress;

use F4u\Shipping\Domain\Model\Client\Client;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Service\ShippingAddress\ShippingAddressParameters;

class ShippingAddress
{
    /**
     * @var ShippingAddressId
     */
    private $shippingAddressId;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var bool
     */
    private $isDefault;

    private function __construct()
    {
    }

    public static function factory(Client $client, ShippingAddressParameters $shippingAddressParameters): self
    {
        $shippingAddress = (new self())->setClient($client)->setAddress($shippingAddressParameters->getAddress());
        $shippingAddress->shippingAddressId = new ShippingAddressId();
        $shippingAddress->manageIsDefaultBy($shippingAddressParameters);
        return $shippingAddress;
    }

    /**
     * @param ShippingAddressParameters $shippingAddressParameters
     */
    public function edit(ShippingAddressParameters $shippingAddressParameters)
    {
        $this->manageIsDefaultBy($shippingAddressParameters);
        $this->address = $shippingAddressParameters->getAddress();
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    private function manageIsDefaultBy(ShippingAddressParameters $shippingAddressParameters)
    {
        if ($shippingAddressParameters->makeAsDefault()) {
            $this->isDefault = true;
        }
    }

    public function makeNotDefault()
    {
        $this->isDefault = false;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    private function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    private function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}