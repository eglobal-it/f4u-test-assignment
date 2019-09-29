<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress as UpdateAddressDTO;
use App\Project\Infrastructure\DeliveryModule\Request\Address\UpdateAddressRequestInterface;
use League\Pipeline\StageInterface;

class CreateDTOForUpdateAddress implements StageInterface
{
    /**
     * @inheritDoc
     *
     * @param UpdateAddressRequestInterface $payload
     *
     * @return UpdateAddressDTO
     */
    public function __invoke($payload)
    {
        return new UpdateAddressDTO(
            $payload->getAddressId(),
            $payload->getZipCode(),
            $payload->getCountry(),
            $payload->getCity(),
            $payload->getStreet()
        );
    }
}
