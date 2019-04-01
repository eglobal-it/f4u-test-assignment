<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:17
 */

namespace F4u\Shipping\Domain\Model\ShippingAddress;


use Ramsey\Uuid\Uuid;

class ShippingAddressId
{
    /**
     * @var string
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    public function __toString()
    {
        return $this->id();
    }

    public function id()
    {
        return $this->id;
    }
}