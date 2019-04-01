<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:44
 */

namespace F4u\Shipping\Domain\Model\ShippingAddress;


class Address
{
    /**
     * @var string
     */
    private $zipcode;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    public function __construct($zipcode, $street, $city, $country)
    {
        $this->zipcode = $zipcode;
        $this->street = $street;
        $this->city = $city;
        $this->country = $country;
    }
}