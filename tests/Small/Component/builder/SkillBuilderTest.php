<?php


namespace App\Tests\Small\Component\builder;

use App\Component\builder\SkillBuilder;
use App\Component\retrieveAll\PartnerRetriever;
use App\Component\retrieveAll\SkillRetriever;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\Skill;
use PHPUnit\Framework\TestCase;

class SkillBuilderTest extends TestCase
{
    private $partnerRetriever;

    private $skillRetriever;

    protected function setUp(): void
    {
        parent::setUp();
        $this->partnerRetriever = $this->createMock(PartnerRetriever::class);
        $this->skillRetriever = $this->createMock(SkillRetriever::class);
    }

    public function init()
    {
        return new SkillBuilder($this->partnerRetriever, $this->skillRetriever);
    }

    public function testBuildPartnerSkillReturnPartnerSkill()
    {
        $partner = $this->createMock(Partner::class);
        $skill = $this->createMock(Skill::class);

        $this->partnerRetriever
            ->expects($this->once())
            ->method('getOne')
            ->with(1)
            ->willReturn($partner);

        $this->skillRetriever
            ->expects($this->once())
            ->method('getOne')
            ->with(1)
            ->willReturn($skill);

        $actual = $this->init()
            ->buildPartnerSkill(1, 1, 10);

        $this->isInstanceOf(PartnerSkill::class, $actual);
    }
}
