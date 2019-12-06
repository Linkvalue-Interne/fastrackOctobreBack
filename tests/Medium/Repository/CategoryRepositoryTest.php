<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Category;
use App\Entity\Skill;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{
    use RepositoryTraitTest;

    public function testSaveCategoryWithoutParentId()
    {
        $category = new Category();

        $category
            ->setName('newCategory');

        $actual = self::$kernel->getContainer()
            ->get(CategoryRepository::class)->save($category);

        $this->assertSame($category, $actual);

        $this->initialState($actual);
    }

    public function testSaveCategoryWithParentId()
    {
        $category = new Category();

        $category
            ->setName('newCategory')
            ->setParentId(1);

        $actual = self::$kernel->getContainer()
            ->get(CategoryRepository::class)->save($category);

        $this->assertSame($category, $actual);

        $this->initialState($actual);
    }
}
