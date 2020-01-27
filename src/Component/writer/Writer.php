<?php


namespace App\Component\writer;

use App\Entity\EntityInterface;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\User;
use App\Repository\PartnerRepository;
use App\Repository\PartnerSkillRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class Writer
{
    /** @var PartnerRepository  */
    private $partnerRepo;

    /** @var PartnerSkillRepository  */
    private $partnerSkillRepo;

    /** @var UserRepository  */
    private $userRepo;

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * Writer constructor.
     *
     * @param PartnerRepository $partnerRepository
     * @param PartnerSkillRepository $partnerSkillRepo
     * @param UserRepository $userRepo
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        PartnerRepository $partnerRepository,
        PartnerSkillRepository $partnerSkillRepo,
        UserRepository $userRepo,
        EntityManagerInterface $manager
    ) {
        $this->partnerRepo = $partnerRepository;
        $this->partnerSkillRepo = $partnerSkillRepo;
        $this->userRepo = $userRepo;
        $this->entityManager = $manager;
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

    /**
     * @param EntityInterface $entity
     */
    public function deleteEntity(EntityInterface $entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
