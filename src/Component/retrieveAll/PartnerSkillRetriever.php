<?php


namespace App\Component\retrieveAll;

use App\Repository\PartnerSkillRepository;

class PartnerSkillRetriever
{
    /** @var PartnerSkillRepository  */
    private $repo;

    public function __construct(PartnerSkillRepository $partnerSkillRepository)
    {
        $this->repo = $partnerSkillRepository;
    }

    /**
     * @param int $partnerId
     * @return array
     */
    public function getAll(int $partnerId): array
    {
        return $this->repo->findBy(['partner' => $partnerId]) ?? [];
    }

    /**
     * @param int $partnerId
     * @param int $skillId
     * @return array|object|null
     */
    public function getOne(int $partnerId, int $skillId)
    {
        return $this->repo->findOneBy(['partner' => $partnerId, 'skill' => $skillId]) ?? [];
    }
}
