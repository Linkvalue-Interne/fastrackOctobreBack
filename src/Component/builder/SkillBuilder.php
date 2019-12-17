<?php


namespace App\Component\builder;

use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\Skill;

class SkillBuilder
{
    public function buildPartnerSkill(Partner $partner, Skill $skill, int $level): PartnerSkill
    {
        $partnerSkill = new PartnerSkill();

        return $partnerSkill
            ->setPartner($partner)
            ->setSkill($skill)
            ->setLevel($level);
    }
}
