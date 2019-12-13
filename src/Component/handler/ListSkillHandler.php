<?php


namespace App\Component\handler;

use App\Component\retrieveAll\CategoryRetriever;
use App\Component\viewer\SkillViewer;
use Symfony\Component\HttpFoundation\Request;

class ListSkillHandler implements HandlerInterface
{
    /** @var CategoryRetriever  */
    private $retriever;

    /** @var SkillViewer  */
    private $viewer;

    public function __construct(CategoryRetriever $retriever, SkillViewer $viewer)
    {
        $this->retriever = $retriever;
        $this->viewer = $viewer;
    }

    public function handle(Request $request): array
    {
        $listSKill = $this->retriever->getAll();

        return $this->viewer->formatList($listSKill) ?? $listSKill;
    }
}
