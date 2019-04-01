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
use F4u\Shipping\Domain\Model\Client\ClientId;

class DoctrineClientId extends GuidType
{
    public function getName()
    {
        return 'ClientId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new ClientId($value);
    }
}
