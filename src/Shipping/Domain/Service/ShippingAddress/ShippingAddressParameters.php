<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 12:31
 */

namespace F4u\Shipping\Domain\Service\ShippingAddress;


use F4u\Shipping\Domain\Model\ShippingAddress\Address;

class ShippingAddressParameters
{
    /**
     * @var Address
     */
    private $address;

    /**
     * @var bool
     */
    private $makeDefault;

    public function __construct(array $makeDefault, Address $address)
    {
        $this->makeDefault = (bool) $makeDefault;
        $this->address = $address;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->country;
    }

    /**
     * @return bool
     */
    public function makeAsDefault()
    {
        return $this->makeDefault;
    }

}