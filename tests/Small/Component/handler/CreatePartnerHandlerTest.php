<?php


namespace App\Tests\Small\Component\handler;

use App\Component\Builder;
use App\Component\handler\CreateHandler;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\Entity\Partner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $this->builder = $this->createMock(Builder::class);
        $this->request = $this->createMock(Request::class);
    }

    public function init()
    {
        return new CreateHandler($this->writer, $this->viewer, $this->builder);
    }

    public function testReturnSuccessHandle()
    {
        $partner = $this->createMock(Partner::class);

        $data = [
            "data" => [
                "form" => [
                    "firstName" => "Dark",
                    "lastName" => "Vador",
                    "job" => "Sith",
                    "email" => "dark.vador@link-value.fr",
                    "phoneNumber" => "01 02 03 04 05",
                    "experience" => 20,
                    "customer" => "Empire",
                    "project" => "Death Stars",
                ]
            ]
        ];

        $dataJson = json_encode($data, true);

        $this->builder
            ->expects($this->once())
            ->method('buildWithForm')
            ->with($data['data']['form'])
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
            ->willReturn($data['data']['form']);

        $this->request
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($dataJson);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($data['data']['form'], $actual);
    }

    public function testReturnBadRequestHandle()
    {
        $data = [
            "data" => [
                "form" => [
                    'fakeAttribute' => 'Dark',
                ]
            ]
        ];

        $dataJson = json_encode($data, true);

        $this->request
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($dataJson);

        $actual = $this->init()->handle($this->request);

        $this->assertSame(['statusCode' => Response::HTTP_BAD_REQUEST], $actual);
    }
}