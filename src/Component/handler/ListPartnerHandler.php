<?php


namespace App\Component\handler;

use App\Component\viewer\PartnerViewer;
use Symfony\Component\HttpFoundation\Request;

class ListPartnerHandler implements HandlerInterface
{
    /** @var PartnerViewer  */
    private $partnerViewer;

    public function __construct(PartnerViewer $partnerViewer)
    {
        $this->partnerViewer = $partnerViewer;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        return $this->partnerViewer->formatList();
    }
}
