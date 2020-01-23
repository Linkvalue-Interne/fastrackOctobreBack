<?php


namespace App\Tests\Small\Component\handler;

use App\Component\builder\PartnerBuilder;
use App\Component\handler\UpdatePartnerHandler;
use App\Component\transformer\PartnerSkillTransformer;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\Skill;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class UpdatePartnerHandlerTest extends KernelTestCase
{
    private $request;

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
            $this->partnerSkillTrans,
            $this->writer
        );
    }

    public function testHandlerUpdateBasicField()
    {
        $expect = [
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
            "favorites" => [],
            "skills" => [],
        ];

        $partner = $this->createConfiguredMock(Partner::class, ['getFavorites' => new ArrayCollection()]);

        $this->request
            ->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($expect, true));

        $this->partnerBuilder
            ->expects($this->once())
            ->method('buildWithForm')
            ->willReturn($partner);

        $this->partnerSkillTrans
            ->expects($this->once())
            ->method('partnerSkillTransformer')
            ->willReturn([]);

        $this->partnerSkillTrans
            ->expects($this->atLeast(2))
            ->method('favoriteSkillTransformer')
            ->willReturn([]);

        $this->writer
            ->expects($this->once())
            ->method('savePartner')
            ->willReturn($partner);

        $this->partnerViewer
            ->expects($this->once())
            ->method('formatShow')
            ->willReturn($expect);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($actual, $expect);
    }

    public function testUpdateHandlerSkill()
    {
        $expect = [
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
            "favorites" => [],
            "skills" => [
                [
                    "id" => 5,
                    "level" =>  30,
                ],
            ],
        ];

        $partnerSkill = $this->createMock(PartnerSkill::class);

        $partner = $this->createConfiguredMock(Partner::class, ['getFavorites' => new ArrayCollection()]);

        $this->request
            ->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($expect, true));

        $this->partnerBuilder
            ->expects($this->once())
            ->method('buildWithForm')
            ->willReturn($partner);

        $this->partnerSkillTrans
            ->expects($this->once())
            ->method('partnerSkillTransformer')
            ->with($expect)
            ->willReturn([$partnerSkill]);

        $this->partnerSkillTrans
            ->expects($this->atLeast(2))
            ->method('favoriteSkillTransformer')
            ->willReturn([]);

        $this->writer
            ->expects($this->once())
            ->method('savePartner')
            ->willReturn($partner);

        $this->partnerViewer
            ->expects($this->once())
            ->method('formatShow')
            ->willReturn($expect);

        $actual = $this->init()->handle($this->request);

        $this->assertSame($actual, $expect);
    }

//    public function testUpdateHandlerDeleteFavorite()
//    {
//        self::markTestSkipped();
//        $expect = [
//            "id" => 2,
//            "firstName" => "Jimmy",
//            "lastName" => "neutron",
//            "job" => "Physician",
//            "email" => "jimmy.hendrix@link-vaue.fr",
//            "phoneNumber" => "01 02 03 04 05",
//            "experience" => 40,
//            "customer" => "client",
//            "project" => "project",
//            "avatar" => "cat4.jpg",
//            "favorites" => [],
//            "skills" => [],
//        ];
//
//        $skill = $this->createMock(Skill::class);
//
//        $arrayCollection = $this->createTestProxy(
//            ArrayCollection::class,
//            [$skill]
//        );
//
//        $partner = $this->createConfiguredMock(
//            Partner::class,
//            ['getFavorites' => $arrayCollection]
//        );
//
//        $this->request
//            ->expects($this->once())
//            ->method('getContent')
//            ->willReturn(json_encode($expect, true));
//
//        $this->partnerBuilder
//            ->expects($this->once())
//            ->method('buildWithForm')
//            ->willReturn($partner);
//
//        $this->partnerSkillTrans
//            ->expects($this->once())
//            ->method('partnerSkillTransformer')
//            ->with($expect)
//            ->willReturn([]);
//
//        $this->partnerSkillTrans
//            ->expects($this->atLeast(2))
//            ->method('favoriteSkillTransformer')
//            ->willReturn([]);
//
//        $partner
//            ->
//
//        $this->writer
//            ->expects($this->once())
//            ->method('savePartner')
//            ->willReturn($partner);
//
//        $this->partnerViewer
//            ->expects($this->once())
//            ->method('formatShow')
//            ->willReturn($expect);
//
//        $actual = $this->init()->handle($this->request);
//
//        $this->assertSame($actual, $expect);
//    }

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
            "avatar" => "cat4.jpg",
        ];

        $authorizedKey = [
            'firstName',
            'lastName',
            'job',
            'email',
            'phoneNumber',
            'experience',
            'customer',
            'project',
            'avatar',
        ];

        $actual = $this->init()->formatData($expect, $authorizedKey);

        $this->assertSame($expect, $actual);
    }
}
