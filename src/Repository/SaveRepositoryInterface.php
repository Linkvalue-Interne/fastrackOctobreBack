<?php


namespace App\Repository;

use App\Entity\EntityInterface;

interface SaveRepositoryInterface
{
    /**
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    public function save(EntityInterface $entity): EntityInterface;
}
