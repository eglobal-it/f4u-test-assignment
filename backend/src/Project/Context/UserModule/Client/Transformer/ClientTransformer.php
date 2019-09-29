<?php

namespace App\Project\Context\UserModule\Client\Transformer;

use App\Project\Context\CommonInterfaces\Entity\EntityInterface;
use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use UnexpectedValueException;

class ClientTransformer implements ClientTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(EntityInterface $entity): array
    {
        if (!$entity instanceof ClientEntityInterface) {
            throw new UnexpectedValueException(
                sprintf(
                    "Entity '%s' must be implements '%s' interface",
                    get_class($entity),
                    ClientEntityInterface::class
                )
            );
        }

        return [
            'id' => $entity->getId(),
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
        ];
    }
}
