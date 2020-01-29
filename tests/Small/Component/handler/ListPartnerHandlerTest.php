<?php


namespace App\Tests\Component\handler;

use App\Component\handler\ListPartnerHandler;
use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use App\Entity\Partner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ListPartnerHandlerTest extends TestCase
{
    private $viewer;

    private $request;

    private $retriever;

    protected function setUp(): void
    {
        parent::setUp();

        $this->viewer = $this->createMock(PartnerViewer::class);
        $this->request = $this->createMock(Request::class);
        $this->retriever = $this->createMock(PartnerRetriever::class);
    }

    public function init()
    {
        return new ListPartnerHandler($this->viewer, $this->retriever);
    }

    public function testHandleSuccessReturnArray()
    {
        $this->markTestSkipped();
        $partner = $this->createMock(Partner::class);
        $listPartner = [$partner, $partner];
        $expect = ['ListFormatElement'];

        $this->request
            ->expects($this->exactly(2))
            ->method('get')
            ->with('options')
            ->willReturn('php');

        $this->retriever
                    ->expects($this->once())
                    ->method('getAllByFilter')
                    ->with('asc', 'php')
                    ->willReturn($listPartner);

        $this->viewer
            ->expects($this->once())
            ->method('formatList')
            ->with($listPartner)
            ->willReturn($expect);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($expect, $actual);
    }

    public function testHandleGetAllReturnNullReturnArray()
    {
        $this->markTestSkipped();
        $listPartner = [];

        $this->request
            ->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(['order', 'search'])
            ->willReturnOnConsecutiveCalls(['asc', 'badSearch']);

        $this->retriever
            ->expects($this->once())
            ->method('getAllByFilter')
            ->with('asc', 'badSearch')
            ->willReturn($listPartner);

        $this->retriever
            ->expects($this->once())
            ->method('getAllByFilter')
            ->willReturn($listPartner);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($listPartner, $actual);
    }
}
