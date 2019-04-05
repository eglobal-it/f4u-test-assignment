<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 02/04/2019
 * Time: 02:18
 */

namespace F4u\Shipping\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressRepository;
use Ramsey\Uuid\Uuid;

class DoctrineShippingAddressRepository implements ShippingAddressRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function nextIdentity(): ShippingAddressId
    {
        return new ShippingAddressId(Uuid::uuid4()->toString());
    }

    public function save(ShippingAddress $shippingAddress)
    {
        $this->entityManager->persist($shippingAddress);
        $this->entityManager->flush();
    }

    public function remove(ShippingAddress $shippingAddress)
    {
        $this->entityManager->remove($shippingAddress);
        $this->entityManager->flush();
    }

    public function saveSet($shippingAddresses)
    {
        foreach ($shippingAddresses as $shippingAddresse) {
            $this->entityManager->persist($shippingAddresse);
        }
        $this->entityManager->flush();
    }

    public function requireById(ShippingAddressId $shippingAddressId): ShippingAddress
    {
        $shippingAddress = $this->byId($shippingAddressId);
        if (!$shippingAddress instanceof ShippingAddress) {
            throw new \RuntimeException('Requested shipping address not found');
        }
        return $shippingAddress;
    }

    public function byId(ShippingAddressId $shippingAddressId)
    {
        return $this->entityManager->find(ShippingAddress::class, $shippingAddressId);
    }
}