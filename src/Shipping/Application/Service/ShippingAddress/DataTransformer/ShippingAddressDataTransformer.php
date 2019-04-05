<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 22:26
 */
namespace F4u\Shipping\Application\Service\ShippingAddress\DataTransformer;

use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use Doctrine\Common\Collections\Collection;

interface ShippingAddressDataTransformer
{
    public function write(ShippingAddress $shippingAddress);

    /**
     * @param Collection|ShippingAddress[] $shippingAddresses
     *
     * @return mixed
     */
    public function writeCollection(Collection $shippingAddresses);

    public function read();
}