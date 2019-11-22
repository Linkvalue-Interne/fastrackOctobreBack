<?php


namespace App\Repository;

use App\Entity\EntityInterface;

trait SaveEntityTrait
{
    // Set in repository construct
    private $registry;

    public function save(EntityInterface $entity): EntityInterface
    {
        $this->registry->getManager()->persist($entity);
        $this->registry->getManager()->flush();

        return $entity;
    }
}
