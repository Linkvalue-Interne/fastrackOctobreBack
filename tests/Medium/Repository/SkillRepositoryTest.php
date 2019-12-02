<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Skill;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SkillRepositoryTest extends KernelTestCase
{
    use RepositoryTraitTest;

    public function testRepositoryTrait()
    {
        $entity = new Skill();

        $entity
            ->setName('php')
            ->setIcon('php.jpg')
        ;

        $actual = self::$kernel->getContainer()
            ->get(SkillRepository::class)->save($entity);

        $this->assertSame($actual, $entity);

        $this->initialState($actual);
    }
}
