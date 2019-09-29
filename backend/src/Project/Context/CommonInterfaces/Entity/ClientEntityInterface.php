<?php

namespace App\Project\Context\CommonInterfaces\Entity;

interface ClientEntityInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;
}
