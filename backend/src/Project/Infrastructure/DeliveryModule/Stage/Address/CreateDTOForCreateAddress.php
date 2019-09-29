<?php

namespace App\Project\Infrastructure\DeliveryModule\Stage\Address;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress as CreateAddressDTO;
use App\Project\Context\DeliveryModule\DeliveryContractInterface;
use App\Project\Infrastructure\Common\Request\ClientIdRequestInterface;
use App\Project\Infrastructure\DeliveryModule\Request\Address\CreateAddressRequestInterface;
use League\Pipeline\StageInterface;

class CreateDTOForCreateAddress extends BaseAddressStage
{
    /**
     * @var StageInterface
     */
    private $clientFinder;

    /**
     * @param DeliveryContractInterface $deliveryContract
     * @param StageInterface $clientFinder
     */
    public function __construct(DeliveryContractInterface $deliveryContract, StageInterface $clientFinder)
    {
        parent::__construct($deliveryContract);

        $this->clientFinder = $clientFinder;
    }

    /**
     * @inheritDoc
     *
     * @param CreateAddressRequestInterface $payload
     *
     * @return CreateAddressDTO
     */
    public function __invoke($payload)
    {
        return new CreateAddressDTO(
            $this->findClient($payload),
            $payload->getZipCode(),
            $payload->getCountry(),
            $payload->getCity(),
            $payload->getStreet()
        );
    }

    /**
     * @param ClientIdRequestInterface $clientIdRequest
     *
     * @return ClientEntityInterface
     */
    private function findClient(ClientIdRequestInterface $clientIdRequest): ClientEntityInterface
    {
        return ($this->clientFinder)($clientIdRequest);
    }
}
