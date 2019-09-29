<?php

namespace App\Project\Context\DeliveryModule\Address\Entity;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Context\CommonInterfaces\Entity\EntityInterface;

interface AddressEntityInterface extends EntityInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return ClientEntityInterface
     */
    public function getClient(): ClientEntityInterface;

    /**
     * @param ClientEntityInterface $client
     *
     * @return self
     */
    public function setClient(ClientEntityInterface $client): self;

    /**
     * @return string
     */
    public function getZipCode(): string;

    /**
     * @param string $zipCode
     *
     * @return self
     */
    public function setZipCode(string $zipCode): self;

    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @param string $country
     *
     * @return self
     */
    public function setCountry(string $country): self;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @param string $city
     *
     * @return self
     */
    public function setCity(string $city): self;

    /**
     * @return string
     */
    public function getStreet(): string;

    /**
     * @param string $street
     *
     * @return self
     */
    public function setStreet(string $street): self;

    /**
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * @param bool $isDefault
     *
     * @return self
     */
    public function setIsDefault(bool $isDefault): self;
}
