<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress as CreateAddressDTO;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;

class CreateAddress extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param CreateAddressDTO $payload
     *
     * @return AddressEntityInterface
     */
    public function __invoke($payload): AddressEntityInterface
    {
        return $this->getDeliveryContract()->createAddress($payload);
    }
}
