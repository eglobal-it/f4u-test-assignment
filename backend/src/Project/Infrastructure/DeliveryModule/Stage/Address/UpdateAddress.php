<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress as UpdateAddressDTO;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;

class UpdateAddress extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param UpdateAddressDTO $payload
     *
     * @return AddressEntityInterface
     */
    public function __invoke($payload): AddressEntityInterface
    {
        return $this->getDeliveryContract()->updateAddress($payload);
    }
}
