<?php


namespace App\Component\handler;

use App\Component\viewer\PartnerViewer;

class PartnerHandler implements HandlerInterface
{
    /** @var PartnerViewer  */
    private $partnerViewer;

    public function __construct(PartnerViewer $viewer)
    {
        $this->partnerViewer = $viewer;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        return $this->partnerViewer->formatList();
    }
}
