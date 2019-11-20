<?php


namespace App\Component\handler;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OnePartnerHandler implements HandlerInterface
{
    /** @var PartnerViewer */
    private $partnerViewer;

    /** @var PartnerRetriever */
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
        $partner = $this->partnerRetriever->getOne($request->get('id'));
        if (null === $partner) {
            return [Response::HTTP_NO_CONTENT];
        }

        return $this->partnerViewer->formatShow($partner);
    }
}
