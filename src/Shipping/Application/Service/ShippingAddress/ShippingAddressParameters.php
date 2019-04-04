<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 12:31
 */

namespace F4u\Shipping\Application\Service\ShippingAddress;


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

    public function __construct(Address $address, bool $makeDefault)
    {
        $this->address = $address;
        $this->makeDefault = $makeDefault;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function makeAsDefault(): bool
    {
        return $this->makeDefault;
    }

}