<?php


namespace App\Tests\Small\Entity;

use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\Skill;
use PHPUnit\Framework\TestCase;

class PartnerSkillTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTraitTest, SetterTraitTest;

    /** {@inheritDoc} */
    public function init()
    {
        return new PartnerSkill();
    }

    /** {@inheritDoc} */
    public function providerProperty(): array
    {
        return [
            ['partner', $this->createMock(Partner::class)],
            ['skill', $this->createMock(Skill::class)],
        ];
    }
}
