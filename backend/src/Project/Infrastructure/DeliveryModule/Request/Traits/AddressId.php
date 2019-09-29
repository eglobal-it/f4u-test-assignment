<?php

namespace App\Project\Infrastructure\DeliveryModule\Request\Traits;

use Symfony\Component\Validator\Constraints as Assert;

trait AddressId
{
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(0)
     */
    private $addressId;

    /**
     * @return int
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @param int $addressId
     *
     * @return self
     */
    public function setAddressId($addressId): self
    {
        $this->addressId = $addressId;

        return $this;
    }
}
