<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:13
 */

namespace F4u\Shipping\Application\Service\ShippingAddress;

use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressRepository;

class RemoveShippingAddress
{
    /**
     * @var ShippingAddressRepository
     */
    private $shippingAddressRepository;

    public function __construct(ShippingAddressRepository $shippingAddressRepository)
    {
        $this->shippingAddressRepository = $shippingAddressRepository;
    }

    public function run(ShippingAddressId $shippingAddressId)
    {
        $shippingAddress = $this->shippingAddressRepository->requireById($shippingAddressId);
        $shippingAddress->checkThatRemovable();
        $this->shippingAddressRepository->remove($shippingAddress);
    }
}