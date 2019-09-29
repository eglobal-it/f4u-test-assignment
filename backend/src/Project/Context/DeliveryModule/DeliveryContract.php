<?php

namespace App\Project\Context\DeliveryModule;

use App\Project\Context\DeliveryModule\Address\AddressServiceInterface;
use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress;
use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;

class DeliveryContract implements DeliveryContractInterface
{
    /**
     * @var AddressServiceInterface
     */
    private $addressService;

    /**
     * @param AddressServiceInterface $addressService
     */
    public function __construct(AddressServiceInterface $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @inheritDoc
     */
    public function getAddressById(int $clientId): AddressEntityInterface
    {
        return $this->addressService->getAddressById($clientId);
    }

    /**
     * @inheritDoc
     */
    public function findAddressesByClientId(int $clientId): array
    {
        return $this->addressService->findAddressesByClientId($clientId);
    }

    /**
     * @inheritDoc
     */
    public function createAddress(CreateAddress $createAddressDto): AddressEntityInterface
    {
        return $this->addressService->createAddress($createAddressDto);
    }

    /**
     * @inheritDoc
     */
    public function updateAddress(UpdateAddress $updateAddressDto): AddressEntityInterface
    {
        return $this->addressService->updateAddress($updateAddressDto);
    }
    /**
     * @inheritDoc
     */
    public function getDefaultAddressByClientId(int $clientId): AddressEntityInterface
    {
        return $this->addressService->getDefaultAddressByClientId($clientId);
    }

    /**
     * @inheritDoc
     */
    public function setDefaultAddressById(int $addressId): AddressEntityInterface
    {
        return $this->addressService->setDefaultAddressById($addressId);
    }

    /**
     * @inheritDoc
     */
    public function deleteAddressById(int $addressId): bool
    {
        return $this->addressService->deleteAddressById($addressId);
    }

    /**
     * @inheritDoc
     */
    public function transformAddressToArray(AddressEntityInterface $addressEntity): array
    {
        return $this->addressService->transformAddressToArray($addressEntity);
    }
}
