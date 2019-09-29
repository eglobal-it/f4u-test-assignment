<?php

use App\Project\Context\DeliveryModule\Address\AddressService;
use App\Project\Context\DeliveryModule\Address\AddressServiceInterface;
use App\Project\Context\DeliveryModule\Address\Repository\AddressRepositoryInterface;
use App\Project\Context\DeliveryModule\Address\Transformer\AddressTransformer;
use App\Project\Context\DeliveryModule\Address\Transformer\AddressTransformerInterface;
use App\Project\Context\DeliveryModule\DeliveryContract;
use App\Project\Context\DeliveryModule\DeliveryContractInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $container) {

    $container->services()->set(AddressTransformerInterface::class, AddressTransformer::class)->private();

    $container->services()->set(AddressServiceInterface::class, AddressService::class)
        ->args([
            ref(AddressRepositoryInterface::class),
            ref(AddressTransformerInterface::class)
        ])
        ->private();

    $container->services()->set(DeliveryContractInterface::class, DeliveryContract::class)
        ->args([
            ref(AddressServiceInterface::class),
        ]);
};
