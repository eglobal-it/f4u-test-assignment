<?php

use App\Project\Context\UserModule\Client\ClientService;
use App\Project\Context\UserModule\Client\ClientServiceInterface;
use App\Project\Context\UserModule\Client\Repository\ClientRepositoryInterface;
use App\Project\Context\UserModule\Client\Transformer\ClientTransformer;
use App\Project\Context\UserModule\Client\Transformer\ClientTransformerInterface;
use App\Project\Context\UserModule\UserContract;
use App\Project\Context\UserModule\UserContractInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $container) {

    $container->services()->set(ClientTransformerInterface::class, ClientTransformer::class)->private();

    $container->services()->set(ClientServiceInterface::class, ClientService::class)
        ->args([
            ref(ClientRepositoryInterface::class),
            ref(ClientTransformerInterface::class)
        ])
        ->private();

    $container->services()->set(UserContractInterface::class, UserContract::class)
        ->args([
            ref(ClientServiceInterface::class),
        ]);
};
