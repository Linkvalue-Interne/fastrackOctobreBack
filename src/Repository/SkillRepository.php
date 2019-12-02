<?php


namespace App\Repository;

use App\Entity\Skill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class SkillRepository
 * @package App\Repository
 */
class SkillRepository extends ServiceEntityRepository implements RepositoryInterface
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
        $this->registry = $registry;
    }
}