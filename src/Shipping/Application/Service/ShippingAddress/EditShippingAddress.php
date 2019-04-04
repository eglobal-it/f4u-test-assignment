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

class EditShippingAddress
{
    /**
     * @var ShippingAddressRepository
     */
    private $repository;

    /**
     * EditShippingAddress constructor.
     *
     * @param ShippingAddressRepository $repository
     */
    public function __construct(ShippingAddressRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ShippingAddressId         $shippingAddressId
     * @param ShippingAddressParameters $shippingAddressParameters
     */
    public function run(
        ShippingAddressId $shippingAddressId,
        ShippingAddressParameters $shippingAddressParameters
    ) {
        $shippingAddress = $this->repository->requireById($shippingAddressId);
        $shippingAddress->edit(
            $shippingAddressParameters->getAddress(),
            $shippingAddressParameters->makeAsDefault()
        );

        if ($shippingAddressParameters->makeAsDefault()) {
            $this->adjustAllShippingAddressesDefaultStatuses($shippingAddress);
            $this->repository->saveSet(
                $shippingAddress->getClient()->getShippingAddresses()
            );
        } else {
            $this->repository->save($shippingAddress);
        }
    }

    /**
     * @param ShippingAddress $shippingAddress
     */
    private function adjustAllShippingAddressesDefaultStatuses(ShippingAddress $shippingAddress)
    {
        foreach ($shippingAddress->getClient()->getShippingAddresses() as $clientShippingAddress) {
            if ($clientShippingAddress !== $shippingAddress) {
                $clientShippingAddress->makeNotDefault();
            }
        }
    }
}