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

    public function getAll()
    {
        return $this->repo->findAll();
    }
}
