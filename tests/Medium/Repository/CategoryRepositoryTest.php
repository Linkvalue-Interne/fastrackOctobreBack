<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Tests\Medium\IntegrationTraitTest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{
    use IntegrationTraitTest;

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
