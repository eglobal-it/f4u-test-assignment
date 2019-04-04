<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 07:55
 */

namespace F4u\Shipping\Domain\Model\Client;

use Doctrine\Common\Collections\Collection;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;

class Client
{
    /**
     * @var ClientId
     */
    private $clientId;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var ShippingAddress[]|Collection
     */
    private $shippingAddresses;

    /**
     *
     * @return Collection|ShippingAddress[]
     */
    public function getShippingAddresses(): Collection
    {
        return $this->shippingAddresses;
    }

    public function isNextShippingAddressForsedBeDefault(): bool
    {
        return $this->getShippingAddresses()->count() === 0;
    }

    public function checkThatShippingAddressIsAddable()
    {
        if ($this->getShippingAddresses()->count() === 3) {
            throw new \OverflowException('Given client already has maximum (3) shipping addresses');
        }
    }
}