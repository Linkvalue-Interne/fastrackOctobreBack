<?php


namespace App\Component\retrieveAll;

use App\Repository\PartnerRepository;

class PartnerRetriever
{
    /** @var PartnerRepository  */
    private $repo;


    public function __construct(PartnerRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @param string $filter
     * @return array
     */
    public function getAll(?string $filter): array
    {
        $params = ($filter) ? ['firstName' => strtoupper($filter)] : ['id' => 'DESC'];

        return $this->repo->findBy(['isActive' => true], $params) ?? [];
    }

    /**
     * @param int $id
     * @return object|array
     */
    public function getOne(int $id)
    {
        return $this->repo->findOneBy(['id' => $id, 'isActive' => true]) ?: [];
    }
}
