<?php

namespace App\Project\Context\DeliveryModule\Address\DTO;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Context\DeliveryModule\Address\Traits\CityClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\ClientClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\CountryClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\StreetClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\ZipCodeClassAttribute;

class CreateAddress
{
    use ClientClassAttribute, ZipCodeClassAttribute, CountryClassAttribute, CityClassAttribute, StreetClassAttribute;

    /**
     * @param ClientEntityInterface $client
     * @param string $zipCode
     * @param string $country
     * @param string $city
     * @param string $street
     */
    public function __construct(
        ClientEntityInterface $client,
        string $zipCode,
        string $country,
        string $city,
        string $street
    ) {
        $this->client = $client;
        $this->zipCode = $zipCode;
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
    }
}
