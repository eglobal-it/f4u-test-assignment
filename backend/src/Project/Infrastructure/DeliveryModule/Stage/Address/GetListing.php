<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Infrastructure\Common\DTO\Listing;

class GetListing extends BaseAddressStage
{
    /**
     * @inheritDoc
     *
     * @param ClientEntityInterface $payload
     */
    public function __invoke($payload)
    {
        return new Listing($this->findAddressesListByClientId($payload->getId()));
    }

    /**
     * @param int $clientId
     *
     * @return array
     */
    private function findAddressesListByClientId(int $clientId): array
    {
        return $this->getDeliveryContract()->findAddressesByClientId($clientId);
    }
}
