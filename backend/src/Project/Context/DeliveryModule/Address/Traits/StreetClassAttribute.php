<?php

namespace App\Project\Context\DeliveryModule\Address\Traits;

trait StreetClassAttribute
{
    /**
     * @var string
     */
    private $street;

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }
}
