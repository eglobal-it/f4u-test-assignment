<?php

namespace App\Project\Context\DeliveryModule\Address\DTO;

use App\Project\Context\DeliveryModule\Address\Traits\CityClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\CountryClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\StreetClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\ZipCodeClassAttribute;

class UpdateAddress
{
    use  ZipCodeClassAttribute, CountryClassAttribute, CityClassAttribute, StreetClassAttribute;

    /**
     * @var int
     */
    private $addressId;

    /**
     * @param int $addressId
     * @param string $zipCode
     * @param string $country
     * @param string $city
     * @param string $street
     */
    public function __construct(
        int $addressId,
        string $zipCode,
        string $country,
        string $city,
        string $street
    ) {
        $this->addressId = $addressId;
        $this->zipCode = $zipCode;
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getAddressId(): int
    {
        return $this->addressId;
    }
}
