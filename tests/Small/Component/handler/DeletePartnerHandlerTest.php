<?php


namespace App\Tests\Small\Component\handler;

use App\Component\handler\DeleteHandler;
use App\Component\retrieveAll\PartnerRetriever;
use App\Component\writer\Writer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeletePartnerHandlerTest extends TestCase
{
    private $writer;

    private $retriever;

    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->writer = $this->createMock(Writer::class);
        $this->retriever = $this->createMock(PartnerRetriever::class);
        $this->request = $this->createMock(Request::class);
    }

    public function init()
    {
        return new DeleteHandler($this->writer, $this->retriever);
    }

    public function testHandleSuccessReturnArray()
    {
        $id = 1;
        $expect = [Response::HTTP_OK];

        $this->request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->willReturn($id);

        $this->retriever
            ->expects($this->once())
            ->method('getOne')
            ->with($id)
            ->willReturn($expect);

        $this->assertIsArray($this->init()->handle($this->request));
    }

    public function testHandleBaDRequestReturnArray()
    {
        $id = 1;
        $expect = [Response::HTTP_BAD_REQUEST];

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

        $this->assertSame($expect, $this->init()->handle($this->request));
    }
}
