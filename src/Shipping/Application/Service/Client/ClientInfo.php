<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 08:13
 */

namespace F4u\Shipping\Application\Service\Client;

use F4u\Shipping\Application\Service\Client\DataTransformer\ClientDataTransformer;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\Client\ClientRepository;

class ClientInfo
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ClientDataTransformer
     */
    private $dataTransformer;

    public function __construct(ClientRepository $clientRepository, ClientDataTransformer $dataTransformer)
    {
        $this->clientRepository = $clientRepository;
        $this->dataTransformer = $dataTransformer;
    }

    public function run(ClientId $clientId)
    {
        $client = $this->clientRepository->requireById($clientId);
        $this->dataTransformer->write($client);
    }
}