<?php

namespace App\Project\Infrastructure\DeliveryModule\Transformer;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Context\DeliveryModule\DeliveryContractInterface;
use App\Project\Infrastructure\Common\Transformer\TransformerInterface;

class AddressEntityToArrayTransformer implements TransformerInterface
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
     * @param AddressEntityInterface $data
     *
     * @inheritDoc
     */
    public function transform($data): array
    {
        return $this->deliveryContract->transformAddressToArray($data);
    }
}
