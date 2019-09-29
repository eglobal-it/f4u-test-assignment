<?php

namespace App\Project\Context\DeliveryModule\Address\Repository;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;

interface AddressRepositoryInterface
{
    /**
     * @param AddressEntityInterface $addressEntity
     *
     * @return bool
     */
    public function save(AddressEntityInterface $addressEntity): bool;

    /**
     * @param AddressEntityInterface $addressEntity
     *
     * @return bool
     */
    public function delete(AddressEntityInterface $addressEntity): bool;

    /**
     * @param int $id
     *
     * @return AddressEntityInterface
     */
    public function findAddressById(int $id): AddressEntityInterface;

    /**
     * @param int $clientId
     *
     * @return AddressEntityInterface[]
     */
    public function findAddressesByClientId(int $clientId): array;

    /**
     * @param int $clientId
     *
     * @return int
     */
    public function findCountAddressByClientId(int $clientId): int;

    /**
     * @param int $clientId
     *
     * @return AddressEntityInterface
     */
    public function findDefaultAddressByClientId(int $clientId): AddressEntityInterface;

    /**
     * @param int $addressId
     *
     * @return AddressEntityInterface
     */
    public function setDefaultAddressById(int $addressId): AddressEntityInterface;
}
