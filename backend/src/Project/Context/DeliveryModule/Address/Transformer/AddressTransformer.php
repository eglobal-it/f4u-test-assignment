<?php

namespace App\Project\Context\DeliveryModule\Address\Transformer;

use App\Project\Context\CommonInterfaces\Entity\EntityInterface;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use UnexpectedValueException;

class AddressTransformer implements AddressTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(EntityInterface $entity): array
    {
        if (!$entity instanceof AddressEntityInterface) {
            throw new UnexpectedValueException(
                sprintf(
                    "Entity '%s' must be implements '%s' interface",
                    get_class($entity),
                    AddressEntityInterface::class
                )
            );
        }

        return [
            'id' => $entity->getId(),
            'zip_code' => $entity->getZipCode(),
            'country' => $entity->getCountry(),
            'city' => $entity->getCity(),
            'street' => $entity->getStreet(),
            'is_default' => $entity->isDefault(),
        ];
    }
}
