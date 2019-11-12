<?php


namespace App\Component\viewer;

use App\Component\retrieveAll\PartnerRetriever;

class PartnerViewer
{
    /** @var PartnerRetriever  */
    private $retriever;

    public function __construct(PartnerRetriever $retriever)
    {
        $this->retriever = $retriever;
    }

    /**
     * @return array
     */
    public function formatList(): array
    {
        $partnerList= [];

        foreach ($this->retriever->getAll() as $partner) {
            $partnerList[] = [
                'id' => $partner->getId(),
                'firstName' => $partner->getFirstname(),
                'lastName' => $partner->getLastname(),
                'job' => $partner->getJob(),
                ]
            ;
        }

        return $partnerList;
    }
}
