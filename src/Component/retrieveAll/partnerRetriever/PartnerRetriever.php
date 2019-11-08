<?php


namespace App\Component\retrieveAll\partnerRetriever;

use App\Repository\PartnerRepository;

class PartnerRetriever
{
    /** @var PartnerRepository  */
    private $repo;

    public function __construct(PartnerRepository $repository)
    {
        $this->repo = $repository;
    }

    public function allPartner()
    {
        return $this->repo->findAll();
    }
}
