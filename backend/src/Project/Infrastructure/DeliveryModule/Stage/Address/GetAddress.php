<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Address\AddressIdRequestInterface;

class GetAddress extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param AddressIdRequestInterface $payload
     */
    public function __invoke($payload): AddressEntityInterface
    {
        return $this->getAddressById($payload->getAddressId());
    }

    /**
     * @param int $id
     *
     * @return AddressEntityInterface
     */
    private function getAddressById(int $id): AddressEntityInterface
    {
        return $this->getDeliveryContract()->getAddressById($id);
    }
}
