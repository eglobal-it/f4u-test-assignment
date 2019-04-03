<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 19:55
 */

namespace F4u\Shipping\Infrastructure\Persistence\Doctrine\CustomTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;

class DoctrineShippingAddressId extends GuidType
{
    public function getName(): string
    {
        return 'ShippingAddressId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->id();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ShippingAddressId
    {
        return new ShippingAddressId($value);
    }
}
