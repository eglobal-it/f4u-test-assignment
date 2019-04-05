<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 05/04/2019
 * Time: 09:05
 */
namespace F4u\Shipping\Infrastructure\Persistence\InMemory\Repository;

use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressRepository;

class InMemoryShippingAddressRepository implements ShippingAddressRepository
{
    private $shippingAddresses = [];
    private $nextIdentity = 'new';

    public function nextIdentity(): ShippingAddressId
    {
        return new ShippingAddressId($this->nextIdentity);
    }

    public function setNextIdentity($value)
    {
        $this->nextIdentity = $value;
        return $this;
    }

    public function reset()
    {
        $this->shippingAddresses = [];
        $this->nextIdentity = 'new';
    }

    public function save(ShippingAddress $shippingAddress)
    {
        $this->shippingAddresses[(string) $shippingAddress->getShippingAddressId()] = $shippingAddress;
    }

    public function saveSet($shippingAddresses)
    {
        foreach ($shippingAddresses as $shippingAddress) {
            $this->save($shippingAddress);
        }
    }

    public function remove(ShippingAddress $shippingAddress)
    {
        if (isset($this->shippingAddresses[(string) $shippingAddress->getShippingAddressId()])) {
            unset($this->shippingAddresses[(string) $shippingAddress->getShippingAddressId()]);
        }
    }

    public function byId(ShippingAddressId $shippingAddressId)
    {
        if (isset($this->shippingAddresses[(string) $shippingAddressId])) {
            return $this->shippingAddresses[(string) $shippingAddressId];
        }
    }

    public function requireById(ShippingAddressId $ShippingAddressId): ShippingAddress
    {
        $shippingAddress = $this->byId($ShippingAddressId);
        if (!$shippingAddress instanceof ShippingAddress) {
            throw new \RuntimeException('Requested shipping address not found');
        }
        return $shippingAddress;
    }
}