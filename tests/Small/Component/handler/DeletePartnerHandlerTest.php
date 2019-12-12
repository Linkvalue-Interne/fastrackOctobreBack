<?php


namespace App\Tests\Small\Component\handler;

use App\Component\handler\DeletePartnerHandler;
use App\Component\retrieveAll\PartnerRetriever;
use App\Component\writer\Writer;
use App\CustomException\InvalidArgumentException;
use App\Entity\Partner;
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
        return new DeletePartnerHandler($this->writer, $this->retriever);
    }

    public function testHandleSuccessReturnArray()
    {
        $id = 1;
        $partner = $this->createMock(Partner::class);
        $expect = ['statusCode' => Response::HTTP_OK];

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

        $this->writer
            ->expects($this->once())
            ->method('savePartner')
            ->willReturn($partner);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($expect, $actual);
    }

    public function testHandleBaDRequestReturnArray()
    {
        $id = 1;
        $this->expectException(InvalidArgumentException::class);

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


        $this->assertSame($this->getExpectedException(), $actual);
    }
}
