<?php

namespace App\Project\Context\UserModule\Client\Entity;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface as BaseClientEntityInterface;
use App\Project\Context\CommonInterfaces\Entity\EntityInterface;

interface ClientEntityInterface extends BaseClientEntityInterface, EntityInterface
{
    /**
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName(string $firstName): self;

    /**
     * @param string $lastName
     *
     * @return ClientEntityInterface
     */
    public function setLastName(string $lastName): self;
}
