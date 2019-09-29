<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Traits;

use Symfony\Component\Validator\Constraints as Assert;

trait AddressFields
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(min="1", max="10")
     */
    private $zipCode;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(max="255")
     */
    private $country;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(max="255")
     */
    private $city;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(max="255")
     */
    private $street;

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return self
     */
    public function setZipCode($zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return self
     */
    public function setCountry($country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return self
     */
    public function setCity($city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return self
     */
    public function setStreet($street): self
    {
        $this->street = $street;

        return $this;
    }
}
