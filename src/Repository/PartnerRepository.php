<?php

namespace App\Repository;

use App\Entity\Partner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PartnerRepository
 * @package App\Repository
 */
class PartnerRepository extends ServiceEntityRepository implements SaveRepositoryInterface
{
    use SaveEntityTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partner::class);
        $this->registry = $registry;
    }
}
