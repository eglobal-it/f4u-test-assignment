<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Infrastructure\DeliveryModule\Request\Address\AddressIdRequestInterface;

class DeleteAddress extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param AddressIdRequestInterface $payload
     *
     * @return bool
     */
    public function __invoke($payload): bool
    {
        return $this->getDeliveryContract()
            ->deleteAddressById($payload->getAddressId());
    }
}
