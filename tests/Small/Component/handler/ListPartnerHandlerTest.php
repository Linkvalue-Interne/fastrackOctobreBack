<?php


namespace App\Tests\Component\handler;

use App\Component\handler\ListPartnerHandler;
use App\Component\viewer\PartnerViewer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ListPartnerHandlerTest extends TestCase
{
    private $viewer;

    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->viewer = $this->createMock(PartnerViewer::class);

        $this->request = $this->createMock(Request::class);
    }

    public function init()
    {
        return new ListPartnerHandler($this->viewer);
    }

    public function testHandleReturnArray()
    {
        $expect = ['ListFormatElement'];

        $this->viewer
            ->expects($this->once())
            ->method('formatList')
            ->willReturn($expect);

        self::assertIsArray($this->init()->handle($this->request));
    }
}
