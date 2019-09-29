<?php

namespace App\Project\Infrastructure\DeliveryModule\Repository;

use App\Project\Context\CommonInterfaces\Exception\EntityNotFoundException;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Context\DeliveryModule\Address\Repository\AddressRepositoryInterface;
use App\Project\Infrastructure\Common\Repository\EntityRepository;
use App\Project\Infrastructure\DeliveryModule\Exception\DefaultAddressNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;

class AddressRepository extends EntityRepository implements AddressRepositoryInterface
{
    /**
     * @inheritDoc
     * @throws ORMException
     */
    public function save(AddressEntityInterface $addressEntity): bool
    {
        return $this->persistAndSaveEntity($addressEntity);
    }

    /**
     * @inheritDoc
     * @throws ORMException
     */
    public function delete(AddressEntityInterface $addressEntity): bool
    {
        return $this->deleteEntity($addressEntity);
    }

    /**
     * @inheritDoc
     * @throws EntityNotFoundException
     */
    public function findAddressById(int $id): AddressEntityInterface
    {
        $address = $this->findOneBy(['id' => $id]);

        if ($address instanceof AddressEntityInterface) {
            return $address;
        }

        throw (new EntityNotFoundException())->setClass(AddressEntityInterface::class);
    }

    /**
     * @inheritDoc
     */
    public function findAddressesByClientId(int $clientId): array
    {
        return $this->addressByClientIdQuery($clientId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritDoc
     *
     * @throws NonUniqueResultException
     */
    public function findCountAddressByClientId(int $clientId): int
    {
        return $this->addressByClientIdQuery($clientId)
            ->select('count(da.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @inheritDoc
     *
     * @throws DefaultAddressNotFoundException
     * @throws NonUniqueResultException
     */
    public function findDefaultAddressByClientId(int $clientId): AddressEntityInterface
    {
        $address = $this->addressByClientIdQuery($clientId)
            ->andWhere('da.isDefault = TRUE')
            ->getQuery()
            ->getOneOrNullResult();

        if ($address instanceof AddressEntityInterface) {
            return $address;
        }

        throw new DefaultAddressNotFoundException();
    }

    /**
     * @inheritDoc
     * @throws EntityNotFoundException
     * @throws ORMException
     */
    public function setDefaultAddressById(int $addressId): AddressEntityInterface
    {
        $address = $this->findAddressById($addressId)->setIsDefault(true);
        try {
            $oldDefaultAddress = $this->findDefaultAddressByClientId($address->getClient()->getId())
                ->setIsDefault(false);
        } catch (DefaultAddressNotFoundException $e) {
            $oldDefaultAddress = null;
        }

        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->persist($address);
            if ($oldDefaultAddress) {
                $this->getEntityManager()->persist($oldDefaultAddress);
            }
            $this->getEntityManager()->flush();
        } catch (ORMException $e) {
            $this->getEntityManager()->rollback();
            throw $e;
        }
        $this->getEntityManager()->commit();

        return $address;
    }

    /**
     * @param int $clientId
     *
     * @return QueryBuilder
     */
    private function addressByClientIdQuery(int $clientId): QueryBuilder
    {
        return $this->createQueryBuilder('da')
            ->innerJoin('da.client', 'c')
            ->andWhere('c.id = :clientId')
            ->setParameters([
                'clientId' => $clientId,
            ]);
    }
}
