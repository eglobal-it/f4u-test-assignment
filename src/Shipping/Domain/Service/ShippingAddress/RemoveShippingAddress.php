<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:13
 */

namespace F4u\Shipping\Domain\Service\ShippingAddress;

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
        $shippingAddress = $this->shippingAddressRepository->byId($shippingAddressId);
        if (!$shippingAddress instanceof ShippingAddress) {
            throw new \RuntimeException('Requested shipping address not found');
        }
        if ($shippingAddress->isDefault()) {
            throw new \RuntimeException('Cannoy remove the default shipping address');
        }
        $this->shippingAddressRepository->remove($shippingAddress);
    }
}