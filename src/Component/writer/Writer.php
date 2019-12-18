<?php


namespace App\Component\writer;

use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Repository\PartnerRepository;
use App\Repository\PartnerSkillRepository;

class Writer
{
    /** @var PartnerRepository  */
    private $partnerRepo;

    /** @var PartnerSkillRepository  */
    private $partnerSkillRepo;

    public function __construct(PartnerRepository $partnerRepository, PartnerSkillRepository $partnerSkillRepo)
    {
        $this->partnerRepo = $partnerRepository;
        $this->partnerSkillRepo = $partnerSkillRepo;
    }

    /**
     * @param Partner $partner
     * @return Partner
     */
    public function savePartner(Partner $partner): Partner
    {
        return $this->partnerRepo->save($partner);
    }

    /**
     * @param PartnerSkill $partnerSkill
     * @return PartnerSkill
     */
    public function savePartnerSkill(PartnerSkill $partnerSkill): PartnerSkill
    {
        return $this->partnerSkillRepo->save($partnerSkill);
    }
}
