<?php

namespace App\Project\Context\DeliveryModule\Address\Traits;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;

trait ClientClassAttribute
{
    /**
     * @var ClientEntityInterface
     */
    private $client;

    /**
     * @return ClientEntityInterface
     */
    public function getClient(): ClientEntityInterface
    {
        return $this->client;
    }
}
