<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Infrastructure\Common\Request\ClientIdRequestInterface;

class GetDefaultAddress extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param ClientIdRequestInterface $payload
     *
     * @return AddressEntityInterface
     */
    public function __invoke($payload): AddressEntityInterface
    {
        return $this->getDeliveryContract()->getDefaultAddressByClientId($payload->getClientId());
    }
}
