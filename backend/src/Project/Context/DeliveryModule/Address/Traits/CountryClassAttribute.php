<?php

namespace App\Project\Context\DeliveryModule\Address\Traits;

trait CountryClassAttribute
{
    /**
     * @var string
     */
    private $country;

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
