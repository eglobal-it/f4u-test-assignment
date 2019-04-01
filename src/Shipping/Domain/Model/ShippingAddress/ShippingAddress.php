<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:02
 */

namespace F4u\Shipping\Domain\Model\ShippingAddress;

use F4u\Shipping\Domain\Model\Client\Client;
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

    /**
     * @param ShippingAddressParameters $shippingAddressParameters
     */
    public function edit(ShippingAddressParameters $shippingAddressParameters)
    {
        if ($shippingAddressParameters->makeAsDefault()) {
            $this->makeAsDefault();
        }
        $this->address = $shippingAddressParameters->getAddress();
    }

    private function makeAsDefault()
    {
        $this->isDefault = true;
    }

    public function makeNotDefault()
    {
        $this->isDefault = false;
    }

    /**
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}