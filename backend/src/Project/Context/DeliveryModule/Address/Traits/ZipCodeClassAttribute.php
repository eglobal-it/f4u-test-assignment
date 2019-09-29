<?php

namespace App\Project\Context\DeliveryModule\Address\Traits;

trait ZipCodeClassAttribute
{
    /**
     * @var string
     */
    private $zipCode;

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }
}
