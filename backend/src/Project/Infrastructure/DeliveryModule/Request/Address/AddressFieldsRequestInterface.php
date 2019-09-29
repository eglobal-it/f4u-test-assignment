<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Address;

interface AddressFieldsRequestInterface
{
    /**
     * @return string
     */
    public function getZipCode();

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @return string
     */
    public function getCity();

    /**
     * @return string
     */
    public function getStreet();
}
