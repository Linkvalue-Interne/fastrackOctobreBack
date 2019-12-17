<?php


namespace App\Tests\Small\Component\builder;

use App\Component\builder\SkillBuilder;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\Skill;
use PHPUnit\Framework\TestCase;

class SkillBuilderTest extends TestCase
{
    public function init()
    {
        return new SkillBuilder();
    }

    public function testBuildPartnerSkillReturnPartnerSkill()
    {
        $actual = $this->init()
            ->buildPartnerSkill(
                $this->createMock(Partner::class),
                $this->createMock(Skill::class),
                25
            );

        self::assertInstanceOf(PartnerSkill::class, $actual);
    }
}
