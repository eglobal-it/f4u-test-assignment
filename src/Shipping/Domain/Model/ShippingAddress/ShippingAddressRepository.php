<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:16
 */

namespace F4u\Shipping\Domain\Model\ShippingAddress;

interface ShippingAddressRepository
{
    /**
     * @param ShippingAddress $shippingAddress
     *
     * @return void
     */
    public function save(ShippingAddress $shippingAddress);

    /**
     * @param ShippingAddress $shippingAddress
     *
     * @return void
     */
    public function remove(ShippingAddress $shippingAddress);

    /**
     * @param ShippingAddress[] $shippingAddresses
     *
     * @return void
     */
    public function saveSet($shippingAddresses);

    /**
     * @param ShippingAddressId $shippingAddressId
     *
     * @return ShippingAddress
     */
    public function byId(ShippingAddressId $shippingAddressId);

    /**
     * @param ShippingAddressId $shippingAddressId
     *
     * @return ShippingAddress
     */
    public function requireById(ShippingAddressId $shippingAddressId);
}