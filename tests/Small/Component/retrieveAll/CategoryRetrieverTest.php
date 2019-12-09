<?php


namespace App\Tests\Small\Component\retrieveAll;

use App\Component\retrieveAll\CategoryRetriever;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use PHPUnit\Framework\TestCase;

class CategoryRetrieverTest extends TestCase
{
    private $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = $this->createMock(CategoryRepository::class);
    }

    public function init()
    {
        return new CategoryRetriever($this->repo);
    }

    public function testGetAllReturnListCategory()
    {
        $category = $this->createMock(Category::class);
        $expect = [$category, $category];

        $this->repo
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($expect);

        $actual = $this->init()->getAll();

        $this->assertSame($expect, $actual);
    }

    public function testGetAllReturnEmptyArray()
    {
        $expect = [];

        $this->repo
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($expect);

        $actual = $this->init()->getAll();

        $this->assertSame($expect, $actual);
    }
}
