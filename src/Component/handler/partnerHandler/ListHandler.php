<?php


namespace App\Component\handler\partnerHandler;

use App\Component\handler\HandlerInterface;
use App\Component\viewer\partnerViewer\PartnerViewer;

class ListHandler implements HandlerInterface
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
