<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 22:32
 */

namespace F4u\Shipping\Application\Service\ShippingAddress\DataTransformer;


use Doctrine\Common\Collections\Collection;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;

class JsonShippingAddressDataTransformer implements ShippingAddressDataTransformer
{
    /**
     * @var string
     */
    private $data;

    public function write(ShippingAddress $client)
    {
        $this->data = json_encode($client);
    }

    public function writeCollection(Collection $shippingAddresses)
    {
        $this->data = json_encode($shippingAddresses->toArray());
    }

    /**
     * @return string
     */
    public function read()
    {
        return $this->data;
    }
}
