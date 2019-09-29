<?php

namespace App\Project\Infrastructure\Common\Request\Traits;

use Symfony\Component\Validator\Constraints as Assert;

trait ClientId
{
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(0)
     */
    private $clientId;

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     *
     * @return self
     */
    public function setClientId($clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }
}
