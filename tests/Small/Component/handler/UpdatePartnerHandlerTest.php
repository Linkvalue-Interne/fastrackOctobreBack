<?php


namespace App\Tests\Small\Component\handler;

use App\Component\builder\PartnerBuilder;
use App\Component\handler\UpdatePartnerHandler;
use App\Component\transformer\PartnerSkillTransformer;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class UpdatePartnerHandlerTest extends KernelTestCase
{
    private $request;

    private $partner;

    private $partnerBuilder;

    private $partnerViewer;

    private $partnerSkill;

    private $partnerSkillTrans;

    private $writer;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $this->partnerBuilder = $this->createMock(PartnerBuilder::class);
        $this->partnerViewer = $this->createMock(PartnerViewer::class);
        $this->writer = $this->createMock(Writer::class);
        $this->partnerSkillTrans = $this->createMock(PartnerSkillTransformer::class);

        $this->request = $this->createMock(Request::class);
        $this->partner = $this->createMock(Partner::class);
        $this->partnerSkill = $this->createMock(PartnerSkill::class);
    }

    /**
     * @return UpdatePartnerHandler
     */
    public function init()
    {
        return new UpdatePartnerHandler(
            $this->partnerBuilder,
            $this->partnerViewer,
            $this->writer,
            $this->partnerSkillTrans
        );
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $content = [
            "id" => 2,
            "firstName" => "Jimmy",
            "lastName" => "neutron",
            "job" => "Physician",
            "email" => "jimmy.hendrix@link-vaue.fr",
            "phoneNumber" => "01 02 03 04 05",
            "experience" => 40,
            "customer" => "client",
            "project" => "project",
            "avatar" => "cat4.jpg",
            "skills" => [
                [
                    "id" => 5,
                    "level" => 28,
                ],
                [
                    "id" => 6,
                    "level" => 22,
                ],
                [
                    "id" => 7,
                    "level" => 0,
                ],
                [
                    "id" => 8,
                    "level" => 12,
                ],
                [
                    "id" => 22,
                    "level" => 12,
                ],
                [
                    "id" => 1,
                    "level" => 99,
                ],
            ]
        ];
    }

    public function testHandlerUpdate()
    {
        $arrayPartnerSkill = [$this->partnerSkill];

        $this->request
            ->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($this->getData(), true));

        $this->partnerBuilder
            ->expects($this->once())
            ->method('buildWithForm')
            ->willReturn($this->partner);

        $this->writer
            ->expects($this->once())
            ->method('savePartner')
            ->willReturn($this->partner);

        $this->partnerSkillTrans
            ->expects($this->once())
            ->method('transformer')
            ->willReturn($arrayPartnerSkill);

        $this->partnerViewer
            ->expects($this->once())
            ->method('formatShow')
            ->willReturn($this->getData());

        $actual = $this->init()->handle($this->request);

        $this->assertSame($actual, $this->getData());
    }

    public function testFormatDataTrait()
    {
        $expect = [
            "firstName" => "Jimmy",
            "lastName" => "neutron",
            "job" => "Physician",
            "email" => "jimmy.hendrix@link-vaue.fr",
            "phoneNumber" => "01 02 03 04 05",
            "experience" => 40,
            "customer" => "client",
            "project" => "project",
        ];

        $actual = $this->init()->formatData($this->getData());

        $this->assertSame($expect, $actual);
    }
}
