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
     * @return array
     */
    public function getAll()
    {
        return $this->repo->findBy(['isActive' => true]) ?: [];
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
