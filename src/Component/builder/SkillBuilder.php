<?php


namespace App\Component\builder;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\retrieveAll\SkillRetriever;
use App\Entity\PartnerSkill;

class SkillBuilder
{
    /** @var PartnerRetriever  */
    private $partnerRetriever;

    /** @var SkillRetriever  */
    private $skillRetriever;

    public function __construct(
        PartnerRetriever $partnerRetriever,
        SkillRetriever $skillRetriever
    ) {
        $this->partnerRetriever = $partnerRetriever;
        $this->skillRetriever = $skillRetriever;
    }

    public function buildPartnerSkill(int $partnerId, int $skillId, int $level): PartnerSkill
    {
        $partnerSkill = new PartnerSkill();

        return $partnerSkill
            ->setPartner($this->partnerRetriever->getOne($partnerId))
            ->setSkill($this->skillRetriever->getOne($skillId))
            ->setLevel($level);
    }
}
