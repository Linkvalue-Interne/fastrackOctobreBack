<?php


namespace App\Component\handler;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use Symfony\Component\HttpFoundation\Request;

class ListPartnerHandler implements HandlerInterface
{
    /** @var PartnerViewer  */
    private $partnerViewer;

    /** @var PartnerRetriever  */
    private $partnerRetriever;

    public function __construct(PartnerViewer $viewer, PartnerRetriever $retriever)
    {
        $this->partnerViewer = $viewer;
        $this->partnerRetriever = $retriever;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        $listPartner = $this->partnerRetriever->getAll();

        return $listPartner ? $this->partnerViewer->formatList($listPartner) : $listPartner;
    }
}
