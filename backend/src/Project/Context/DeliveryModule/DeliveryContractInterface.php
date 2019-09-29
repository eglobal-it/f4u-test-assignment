<?php

namespace App\Project\Context\DeliveryModule;

use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress;
use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;

interface DeliveryContractInterface
{
    /**
     * @param int $clientId
     *
     * @return AddressEntityInterface
     */
    public function getAddressById(int $clientId): AddressEntityInterface;

    /**
     * @param int $clientId
     *
     * @return array
     */
    public function findAddressesByClientId(int $clientId): array;

    /**
     * @param CreateAddress $createAddressDto
     *
     * @return AddressEntityInterface
     */
    public function createAddress(CreateAddress $createAddressDto): AddressEntityInterface;

    /**
     * @param UpdateAddress $updateAddressDto
     *
     * @return AddressEntityInterface
     */
    public function updateAddress(UpdateAddress $updateAddressDto): AddressEntityInterface;

    /**
     * @param int $clientId
     *
     * @return AddressEntityInterface
     */
    public function getDefaultAddressByClientId(int $clientId): AddressEntityInterface;

    /**
     * @param int $addressId
     *
     * @return AddressEntityInterface
     */
    public function setDefaultAddressById(int $addressId): AddressEntityInterface;

    /**
     * @param int $addressId
     *
     * @return bool
     */
    public function deleteAddressById(int $addressId): bool;

    /**
     * @param AddressEntityInterface $addressEntity
     *
     * @return array
     */
    public function transformAddressToArray(AddressEntityInterface $addressEntity): array;
}
