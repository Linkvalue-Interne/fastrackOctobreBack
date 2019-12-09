<?php


namespace App\Component\handler;

use App\Component\builder\SkillBuilder;
use App\Component\retrieveAll\CategoryRetriever;
use Symfony\Component\HttpFoundation\Request;

class ListSkillHandler implements HandlerInterface
{
    /** @var CategoryRetriever  */
    private $retriever;

    /** @var SkillBuilder  */
    private $builder;

    public function __construct(CategoryRetriever $retriever, SkillBuilder $builder)
    {
        $this->retriever = $retriever;
        $this->builder = $builder;
    }

    public function handle(Request $request): array
    {
        $listSKill = $this->retriever->getAll();

        return $this->builder->formatList($listSKill) ?? $listSKill;
    }
}
