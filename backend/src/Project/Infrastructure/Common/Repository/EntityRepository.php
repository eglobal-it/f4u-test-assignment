<?php

namespace App\Project\Infrastructure\Common\Repository;

use App\Project\Context\CommonInterfaces\Entity\EntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;

class EntityRepository extends ServiceEntityRepository
{
    /**
     * @param EntityInterface $entity
     *
     * @return bool
     * @throws ORMException
     */
    protected function persistAndSaveEntity(EntityInterface $entity): bool
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);

        return true;
    }

    /**
     * @param EntityInterface $entity
     *
     * @return bool
     * @throws ORMException
     */
    protected function deleteEntity(EntityInterface $entity): bool
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush($entity);

        return true;
    }
}
