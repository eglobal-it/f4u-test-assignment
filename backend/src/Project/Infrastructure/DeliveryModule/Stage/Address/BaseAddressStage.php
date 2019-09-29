<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\DeliveryModule\DeliveryContractInterface;
use League\Pipeline\StageInterface;

abstract class BaseAddressStage implements StageInterface
{
    /**
     * @var DeliveryContractInterface
     */
    private $deliveryContract;

    /**
     * @param DeliveryContractInterface $deliveryContract
     */
    public function __construct(DeliveryContractInterface $deliveryContract)
    {
        $this->deliveryContract = $deliveryContract;
    }

    /**
     * @return DeliveryContractInterface
     */
    protected function getDeliveryContract(): DeliveryContractInterface
    {
        return $this->deliveryContract;
    }
}

