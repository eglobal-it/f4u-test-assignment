<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Address\AddressIdRequestInterface;

class SetDefaultAddress extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param AddressIdRequestInterface $payload
     *
     * @return AddressEntityInterface
     */
    public function __invoke($payload): AddressEntityInterface
    {
        return $this->setDefaultAddressByAddressId($payload);
    }

    /**
     * @param AddressIdRequestInterface $addressIdRequest
     *
     * @return AddressEntityInterface
     */
    private function setDefaultAddressByAddressId(AddressIdRequestInterface $addressIdRequest): AddressEntityInterface
    {
        return $this->getDeliveryContract()
            ->setDefaultAddressById($addressIdRequest->getAddressId());
    }
}
