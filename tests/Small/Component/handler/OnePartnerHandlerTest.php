<?php


namespace App\Tests\Component\handler;

use App\Component\handler\OnePartnerHandler;
use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use App\Entity\Partner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OnePartnerHandlerTest extends TestCase
{
    private $viewer;

    private $request;

    private $retriever;

    protected function setUp(): void
    {
        parent::setUp();

        $this->viewer = $this->createMock(PartnerViewer::class);
        $this->retriever = $this->createMock(PartnerRetriever::class);
        $this->request = $this->createMock(Request::class);
    }

    public function init()
    {
        return new OnePartnerHandler($this->viewer, $this->retriever);
    }

    public function testHandleSuccessReturnArray()
    {
        $id = 1;
        $partner = $this->createMock(Partner::class);
        $expect = ['FormatPartner'];

        $this->request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->willReturn($id);

        $this->retriever
            ->expects($this->once())
            ->method('getOne')
            ->with($id)
            ->willReturn($partner);

        $this->viewer
            ->expects($this->once())
            ->method('formatShow')
            ->with($partner)
            ->willReturn($expect);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($expect, $actual);
    }

    public function testHandleBadRequest()
    {
        $id = 1;

        $this->request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->willReturn($id);

        $this->retriever
            ->expects($this->once())
            ->method('getOne')
            ->with($id)
            ->willReturn(null);

        $actual = $this->init()->handle($this->request);

        $this->assertSame([Response::HTTP_NO_CONTENT], $actual);
    }
}
