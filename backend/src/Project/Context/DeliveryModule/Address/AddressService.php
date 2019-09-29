<?php

namespace App\Project\Context\DeliveryModule\Address;

use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress;
use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntity;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Context\DeliveryModule\Address\Exception\AttemptToRemoveDefaultAddressException;
use App\Project\Context\DeliveryModule\Address\Exception\MaxCountAddressesException;
use App\Project\Context\DeliveryModule\Address\Repository\AddressRepositoryInterface;
use App\Project\Context\DeliveryModule\Address\Transformer\AddressTransformerInterface;

class AddressService implements AddressServiceInterface
{
    /**
     * @var int
     */
    private const MAX_COUNT_ADDRESSES = 3;

    /**
     * @var int
     */
    private const EXCEPTION_CODE = 400;

    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * @var AddressTransformerInterface
     */
    private $addressTransformer;

    /**
     * @param AddressRepositoryInterface $addressRepository
     * @param AddressTransformerInterface $addressTransformer
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository,
        AddressTransformerInterface $addressTransformer
    ) {
        $this->addressRepository = $addressRepository;
        $this->addressTransformer = $addressTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getAddressById(int $clientId): AddressEntityInterface
    {
        return $this->addressRepository->findAddressById($clientId);
    }

    /**
     * @inheritDoc
     */
    public function findAddressesByClientId(int $clientId): array
    {
        return $this->addressRepository->findAddressesByClientId($clientId);
    }

    /**
     * @inheritDoc
     * @throws MaxCountAddressesException
     */
    public function createAddress(CreateAddress $createAddressDto): AddressEntityInterface
    {
        $addressesCount = $this->addressRepository->findCountAddressByClientId($createAddressDto->getClient()->getId());

        $this->isCanCreate($addressesCount);

        $addressEntity = (new AddressEntity())
            ->setClient($createAddressDto->getClient())
            ->setZipCode($createAddressDto->getZipCode())
            ->setCountry($createAddressDto->getCountry())
            ->setCity($createAddressDto->getCity())
            ->setStreet($createAddressDto->getStreet())
            ->setIsDefault($addressesCount === 0);

        $this->addressRepository->save($addressEntity);

        return $addressEntity;
    }

    /**
     * @inheritDoc
     */
    public function updateAddress(UpdateAddress $updateAddressDto): AddressEntityInterface
    {
        $addressEntity = $this->addressRepository->findAddressById($updateAddressDto->getAddressId());

        $addressEntity
            ->setZipCode($updateAddressDto->getZipCode())
            ->setCountry($updateAddressDto->getCountry())
            ->setCity($updateAddressDto->getCity())
            ->setStreet($updateAddressDto->getStreet());

        $this->addressRepository->save($addressEntity);

        return $addressEntity;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultAddressByClientId(int $clientId): AddressEntityInterface
    {
        return $this->addressRepository->findDefaultAddressByClientId($clientId);
    }

    /**
     * @inheritDoc
     */
    public function setDefaultAddressById(int $addressId): AddressEntityInterface
    {
        return $this->addressRepository->setDefaultAddressById($addressId);
    }

    /**
     * @inheritDoc
     * @throws AttemptToRemoveDefaultAddressException
     */
    public function deleteAddressById(int $addressId): bool
    {
        $addressEntity = $this->addressRepository->findAddressById($addressId);

        $this->isCanDelete($addressEntity);

        return $this->addressRepository->delete($addressEntity);
    }

    /**
     * @inheritDoc
     */
    public function transformAddressToArray(AddressEntityInterface $addressEntity): array
    {
        return $this->addressTransformer->transform($addressEntity);
    }

    /**
     * @param int $addressesCount
     *
     * @return void
     * @throws MaxCountAddressesException
     */
    private function isCanCreate(int $addressesCount): void
    {
        if ($addressesCount >= self::MAX_COUNT_ADDRESSES) {
            throw new MaxCountAddressesException('Exceeded maximum address count', self::EXCEPTION_CODE);
        }
    }

    /**
     * @param AddressEntityInterface $addressEntity
     *
     * @return void
     * @throws AttemptToRemoveDefaultAddressException
     */
    private function isCanDelete(AddressEntityInterface $addressEntity): void
    {
        if ($addressEntity->isDefault()) {
            throw new AttemptToRemoveDefaultAddressException(
                'Deleting the default address is prohibited',
                self::EXCEPTION_CODE
            );
        }
    }
}
