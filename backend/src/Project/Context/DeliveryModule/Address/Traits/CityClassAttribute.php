<?php

namespace App\Project\Context\DeliveryModule\Address\Traits;

trait CityClassAttribute
{
    /**
     * @var string
     */
    private $city;

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
}
