<?php


namespace App\Tests\Component\handler;

use App\Component\handler\OnePartnerHandler;
use App\Component\viewer\PartnerViewer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class OnePartnerHandlerTest extends TestCase
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
        return new OnePartnerHandler($this->viewer);
    }

    public function testHandleReturnArray()
    {
        $expect = ['showFormatElement'];

        $this->request
            ->method('get')
            ->with('id')
            ->willReturn(1);

        $this->viewer
            ->expects($this->once())
            ->method('formatShow')
            ->with($this->request->get('id'))
            ->willReturn($expect);

        self::assertIsArray($this->init()->handle($this->request));
    }
}
