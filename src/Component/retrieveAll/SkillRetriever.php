<?php


namespace App\Component\retrieveAll;

use App\Repository\SkillRepository;

class SkillRetriever
{
    /** @var SkillRepository  */
    private $repo;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->repo = $skillRepository;
    }

    /**
     * @param int $id
     * @return array|object|null
     */
    public function getOne(int $id)
    {
        return $this->repo->findOneBy(['id' => $id]) ?? [];
    }
}
