<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{
    use RepositoryTraitTest;

    public function testRepositoryTrait()
    {
        $entity = new Category();

        $entity
            ->setName('backend')
            ->setSkillId(1);
        ;

        $actual = self::$kernel->getContainer()
            ->get(CategoryRepository::class)->save($entity);

        $this->assertSame($entity, $actual);

        $this->initialState($actual);
    }
}
