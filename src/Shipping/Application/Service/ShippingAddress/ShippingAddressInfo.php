<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:13
 */

namespace F4u\Shipping\Application\Service\ShippingAddress;

use F4u\Shipping\Application\Service\ShippingAddress\DataTransformer\ShippingAddressDataTransformer;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressRepository;

class ShippingAddressInfo
{
    /**
     * @var ShippingAddressRepository
     */
    private $repository;

    /**
     * @var ShippingAddressDataTransformer
     */
    private $dataTransformer;

    public function __construct(ShippingAddressRepository $repository, ShippingAddressDataTransformer $dataTransformer)
    {
        $this->repository = $repository;
        $this->dataTransformer = $dataTransformer;
    }

    public function run(ShippingAddressId $shippingAddressId)
    {
        $shippingAddress = $this->repository->requireById($shippingAddressId);
        $this->dataTransformer->write($shippingAddress);
    }
}