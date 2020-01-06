<?php


namespace App\Tests\Small\Component\handler;

use App\Component\builder\PartnerBuilder;
use App\Component\handler\CreatePartnerHandler;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\Entity\Partner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CreatePartnerHandlerTest extends TestCase
{
    private $writer;

    private $viewer;

    private $builder;

    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->writer = $this->createMock(Writer::class);
        $this->viewer = $this->createMock(PartnerViewer::class);
        $this->builder = $this->createMock(PartnerBuilder::class);
        $this->request = $this->createMock(Request::class);
    }

    public function init()
    {
        return new CreatePartnerHandler($this->writer, $this->viewer, $this->builder);
    }

    public function testReturnSuccessHandle()
    {
        $partner = $this->createMock(Partner::class);

        $data = [
            "firstName" => "Dark",
            "lastName" => "Vador",
            "job" => "Sith",
            "email" => "dark.vador@link-value.fr",
            "phoneNumber" => "01 02 03 04 05",
            "experience" => 20,
            "customer" => "Empire",
            "avatar" => "image.png"
        ];

        $this->builder
            ->expects($this->once())
            ->method('buildWithForm')
            ->with($data)
            ->willReturn($partner);

        $this->writer
            ->expects($this->once())
            ->method('savePartner')
            ->with($partner)
            ->willReturn($partner);

        $this->viewer
            ->expects($this->once())
            ->method('formatShow')
            ->with($partner)
            ->willReturn($data);

        $this->request->request = $this->createMock(ParameterBag::class);

        $this->request->request
            ->expects($this->once())
            ->method('all')
            ->willReturn($data);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($data, $actual);
    }
}
