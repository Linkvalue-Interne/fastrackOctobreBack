<?php


namespace App\Repository;

use App\Entity\PartnerSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class PartnerSkillRepository extends ServiceEntityRepository implements RepositoryInterface
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartnerSkill::class);
        $this->registry = $registry;
    }
}
