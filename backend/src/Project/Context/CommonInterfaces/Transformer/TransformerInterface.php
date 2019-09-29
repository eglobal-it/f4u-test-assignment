<?php

namespace App\Project\Context\CommonInterfaces\Transformer;

use App\Project\Context\CommonInterfaces\Entity\EntityInterface;

interface TransformerInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return array
     */
    public function transform(EntityInterface $entity): array;
}
