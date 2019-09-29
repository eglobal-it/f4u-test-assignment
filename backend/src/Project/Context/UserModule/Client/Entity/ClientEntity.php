<?php

namespace App\Project\Context\UserModule\Client\Entity;

class ClientEntity implements ClientEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @inheritDoc
     */
    public function setFirstName(string $firstName): ClientEntityInterface
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @inheritDoc
     */
    public function setLastName(string $lastName): ClientEntityInterface
    {
        $this->lastName = $lastName;

        return $this;
    }
}
