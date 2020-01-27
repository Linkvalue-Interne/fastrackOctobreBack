<?php


namespace App\Component\writer;

use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\User;
use App\Repository\PartnerRepository;
use App\Repository\PartnerSkillRepository;
use App\Repository\UserRepository;

class Writer
{
    /** @var PartnerRepository  */
    private $partnerRepo;

    /** @var PartnerSkillRepository  */
    private $partnerSkillRepo;

    /** @var UserRepository  */
    private $userRepo;

    /**
     * Writer constructor.
     *
     * @param PartnerRepository $partnerRepository
     * @param PartnerSkillRepository $partnerSkillRepo
     * @param UserRepository $userRepo
     */
    public function __construct(
        PartnerRepository $partnerRepository,
        PartnerSkillRepository $partnerSkillRepo,
        UserRepository $userRepo
    ) {
        $this->partnerRepo = $partnerRepository;
        $this->partnerSkillRepo = $partnerSkillRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * @param Partner $partner
     *
     * @return Partner
     */
    public function savePartner(Partner $partner): Partner
    {
        return $this->partnerRepo->save($partner);
    }

    /**
     * @param PartnerSkill $partnerSkill
     *
     * @return PartnerSkill
     */
    public function savePartnerSkill(PartnerSkill $partnerSkill): PartnerSkill
    {
        return $this->partnerSkillRepo->save($partnerSkill);
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function saveUser(User $user): User
    {
        return $this->userRepo->save($user);
    }
}
