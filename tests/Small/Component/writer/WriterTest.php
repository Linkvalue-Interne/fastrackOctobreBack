<?php


namespace App\Tests\Small\Component\writer;

use App\Component\writer\Writer;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Repository\PartnerRepository;
use App\Repository\PartnerSkillRepository;
use PHPUnit\Framework\TestCase;

class WriterTest extends TestCase
{
    private $partnerRepo;

    private $partnerSkillRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->partnerRepo = $this->createMock(PartnerRepository::class);
        $this->partnerSkillRepo = $this->createMock(PartnerSkillRepository::class);
    }

    public function init()
    {
        return new Writer($this->partnerRepo, $this->partnerSkillRepo);
    }

    public function testSavePartnerReturnPartnerEntity()
    {
        $partner = $this->createMock(Partner::class);

        $this->partnerRepo
            ->expects($this->once())
            ->method('save')
            ->with($partner)
            ->willReturn($partner);

        $actual = $this->init()->savePartner($partner);

        $this->assertSame($partner, $actual);
    }

    public function testSavePartnerSkillReturnPartnerSkillEntity()
    {
        $partnerSkill = $this->createMock(PartnerSkill::class);

        $this->partnerSkillRepo
            ->expects($this->once())
            ->method('save')
            ->with($partnerSkill)
            ->willReturn($partnerSkill);

        $actual = $this->init()->savePartnerSkill($partnerSkill);

        $this->assertSame($partnerSkill, $actual);
    }
}
