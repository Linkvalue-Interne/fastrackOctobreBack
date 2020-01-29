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
     *
     * @return array
     */
    public function handle(Request $request): array
    {
        $partnerList = $this->partnerRetriever
            ->getAllByFilter(
                $request->get('order'),
                $request->get('options')
            );

        return $this->partnerViewer->formatList($partnerList);
    }
}
