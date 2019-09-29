<?php

namespace App\Project\Context\DeliveryModule\Address\Entity;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Context\DeliveryModule\Address\Traits\CityClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\ClientClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\CountryClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\StreetClassAttribute;
use App\Project\Context\DeliveryModule\Address\Traits\ZipCodeClassAttribute;

class AddressEntity implements AddressEntityInterface
{
    use ClientClassAttribute, ZipCodeClassAttribute, CountryClassAttribute, CityClassAttribute, StreetClassAttribute;

    /**
     * @var int
     */
    private $id;

    /**
     * @var boolean
     */
    private $isDefault;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setClient(ClientEntityInterface $client): AddressEntityInterface
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param string $zipCode
     *
     * @return AddressEntity
     */
    public function setZipCode(string $zipCode): AddressEntityInterface
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @param string $country
     *
     * @return AddressEntity
     */
    public function setCountry(string $country): AddressEntityInterface
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return AddressEntity
     */
    public function setCity(string $city): AddressEntityInterface
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $street
     *
     * @return AddressEntity
     */
    public function setStreet(string $street): AddressEntityInterface
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     *
     * @return AddressEntity
     */
    public function setIsDefault(bool $isDefault): AddressEntityInterface
    {
        $this->isDefault = $isDefault;

        return $this;
    }
}
