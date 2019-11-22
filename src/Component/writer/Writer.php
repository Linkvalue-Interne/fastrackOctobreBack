<?php


namespace App\Component\writer;

use App\Entity\Partner;
use App\Repository\PartnerRepository;

class Writer
{
    /** @var PartnerRepository  */
    private $repository;

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->repository = $partnerRepository;
    }

    /**
     * @param Partner $partner
     * @return Partner
     */
    public function savePartner(Partner $partner): Partner
    {
        return $this->repository->save($partner);
    }
}
