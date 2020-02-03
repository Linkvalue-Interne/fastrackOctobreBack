<?php


namespace App\Component\retrieveAll;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class SkillRetriever
{
    /** @var SkillRepository  */
    private $repo;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->repo = $skillRepository;
    }

    /**
     * @param int $id
     *
     * @return array|object|null
     */
    public function getOne(int $id)
    {
        return $this->repo->findOneBy(['id' => $id]) ?? [];
    }

    /**
     * @param string|null $search1
     * @param string|null $search2
     *
     * @return mixed
     */
    public function getSkillsByParam(string $search1 = null, string $search2 = null)
    {
        $query = $this->repo->createQueryBuilder('s');
        $params = new ArrayCollection();
        $params->add(new Parameter('name1', '%'.$search1.'%'));
        if ($search2) {
            $params->add(new Parameter('name2', '%'.$search2.'%'));
        }

        $request = 's.name LIKE :name1';
        $request .= $search2 ? ' OR s.name LIKE :name2' : '';

        return $query
            ->where($request)
            ->setParameters($params)
            ->getQuery()
            ->getResult()
            ;
    }
}
