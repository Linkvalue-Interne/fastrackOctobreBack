<?php


namespace App\Component\viewer\partnerViewer;

use App\Component\retrieveAll\partnerRetriever\PartnerRetriever;

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
    public function formatList()
    {
        $partnerList= [];

        foreach ($this->retriever->allPartner() as $partner) {
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
