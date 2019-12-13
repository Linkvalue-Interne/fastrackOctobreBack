<?php


namespace App\Tests\Small\Component\handler;

use App\Component\handler\ListSkillHandler;
use App\Component\retrieveAll\CategoryRetriever;
use App\Component\viewer\SkillViewer;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ListSkillHandlerTest extends TestCase
{
    private $retriever;

    private $viewer;

    private $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->retriever = $this->createMock(CategoryRetriever::class);
        $this->viewer = $this->createMock(SkillViewer::class);
        $this->request = $this->createMock(Request::class);
    }

    public function init()
    {
        return new ListSkillHandler($this->retriever, $this->viewer);
    }

    public function testHandleSuccess()
    {
        $category = $this->createMock(Category::class);
        $listCategories = [$category, $category];
        $expect = ['listFormatted'];

        $this->retriever
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($listCategories);

        $this->viewer
            ->expects($this->once())
            ->method('formatList')
            ->with($listCategories)
            ->willReturn($expect);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($expect, $actual);
    }

    public function testHandleReturnEmptyArray()
    {
        $listCategories = [];
        $expect = [];

        $this->retriever
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($listCategories);

        $this->viewer
            ->expects($this->once())
            ->method('formatList')
            ->with($listCategories)
            ->willReturn($expect);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($expect, $actual);
    }
}
