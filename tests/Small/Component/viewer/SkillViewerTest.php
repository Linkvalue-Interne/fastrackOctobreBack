<?php


namespace App\Tests\Small\Component\viewer;

use App\Component\viewer\SkillViewer;
use App\Entity\Category;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SkillViewerTest extends TestCase
{
    private $category;

    private $arrayCollection;

    protected function setUp(): void
    {
        $this->category = $this->createMock(Category::class);
        $this->arrayCollection = $this->createMock(Collection::class);
    }

    public function init()
    {
        return new SkillViewer();
    }

    public function testFormatList()
    {
        $cat1 = $this->createMock(Category::class);
        $cat1
            ->expects($this->any())
            ->method('getId')
            ->willReturn(1);
        $cat1
            ->expects($this->any())
            ->method('getSkills')
            ->willReturn($this->arrayCollection);

        $cat2 = $this->createMock(Category::class);
        $cat2
            ->expects($this->any())
            ->method('getId')
            ->willReturn(2);
        $cat2
            ->expects($this->any())
            ->method('getSkills')
            ->willReturn($this->arrayCollection);

        $cat3 = $this->createMock(Category::class);
        $cat3
            ->expects($this->any())
            ->method('getId')
            ->willReturn(3);
        $cat3
            ->expects($this->any())
            ->method('getSkills')
            ->willReturn($this->arrayCollection);
        $cat3
            ->expects($this->any())
            ->method('getParentId')
            ->willReturn(2);

        $data = [$cat1, $cat2, $cat3];

        $expect = [
            [
                'id' => 1,
                'name' => null,
                'subCategory' => [],
                'skills' => null,
            ],
            [
                'id' => 2,
                'name' => null,
                'subCategory' => [
                    [
                        "id" => 3,
                        "name" => null,
                        "subCategory" => [],
                        "skills" => null,
                    ],
                ],
                'skills' => null,
            ],
        ];

        $actual = $this->init()->formatList($data);

        $this->assertSame($expect, $actual);
    }
}
