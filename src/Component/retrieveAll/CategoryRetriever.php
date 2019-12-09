<?php


namespace App\Component\retrieveAll;

use App\Repository\CategoryRepository;

class CategoryRetriever
{
    /** @var CategoryRepository  */
    private $repo;

    public function __construct(CategoryRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->repo->findAll() ?: [];
    }
}
