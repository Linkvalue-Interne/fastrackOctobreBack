<?php


namespace App\Component\handler;

use App\Component\viewer\PartnerViewer;
use Symfony\Component\HttpFoundation\Request;

class OnePartnerHandler implements HandlerInterface
{
    /** @var PartnerViewer  */
    private $partnerViewer;

    public function __construct(PartnerViewer $viewer)
    {
        $this->partnerViewer = $viewer;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        return $this->partnerViewer->formatShow($request->get('id'));
    }
}
