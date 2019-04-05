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

class ShippingAddress implements \JsonSerializable
{
    /**
     * @var ShippingAddressId
     */
    private $shippingAddressId;

    /**
     * @var ClientId
     */
    private $clientId;

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

    public static function factory(Client $client, Address $Address, bool $makeAsDefault): self
    {
        $shippingAddress = (new self())->setClient($client)->setAddress($Address);
        $shippingAddress->shippingAddressId = new ShippingAddressId();
        $shippingAddress->isDefault = $makeAsDefault;
        return $shippingAddress;
    }

    public function edit(Address $address, bool $makeAsDefault)
    {
        if ($makeAsDefault) {
            $this->isDefault = true;
        }
        $this->address = $address;
    }

    public function checkThatRemovable()
    {
        if ($this->isDefault) {
            throw new \RuntimeException('Cannot remove the default shipping address');
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

    public function jsonSerialize()
    {
        return [
            'shipping_address_uuid' => (string) $this->shippingAddressId,
            'client_uuid' => (string) $this->clientId,
            'is_default' => $this->isDefault,
            'zipcode' => $this->address->getZipcode(),
            'street' => $this->address->getStreet(),
            'city' => $this->address->getCity(),
            'country' => $this->address->getCountry(),
        ];
    }
}