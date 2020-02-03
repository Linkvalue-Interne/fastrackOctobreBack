<?php

namespace App\Component\retrieveAll;

use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class PartnerRetriever
{
    /** @var PartnerRepository  */
    private $partnerRepo;

    /** @var SkillRetriever */
    private $skillRetriever;

    public function __construct(PartnerRepository $PartnerRepository, SkillRetriever $skillRetriever)
    {
        $this->partnerRepo = $PartnerRepository;
        $this->skillRetriever = $skillRetriever;
    }

    public function getAllByFilter(string $order, string $search = null, bool $isActive = true)
    {
        $query = $this->partnerRepo->createQueryBuilder('p');

        if ('desc' == $order || 'asc' == $order) {
            $query
                ->orderBy('p.id', strtoupper($order));
        }

        if ($search === 'null') {
            $search = null;
        }

        if ($search) {
            $search = explode(' ', $search);
            if (1 == count($search)) {
                $skills = $this->skillRetriever->getSkillsByParam($search[0]);
                $skillCondition = $this->getSkillsCondition(
                    'p.firstName LIKE :param OR p.lastName LIKE :param',
                    $skills
                );
                $skillConditionParam = $this->getSkillConditionParam($skills);
                $skillConditionParam->add(new Parameter('param', '%'.$search[0].'%'));
            }
            if (1 < count($search)) {
                $skills = $this->skillRetriever->getSkillsByParam($search[0], $search[1]);

                $skillCondition = $this->getSkillsCondition(
                    'p.firstName LIKE :name1 OR p.firstName LIKE :name2 OR p.lastName LIKE :name1 OR p.lastName LIKE :name2',
                    $skills
                );

                $skillConditionParam = $this->getSkillConditionParam($skills);
                $skillConditionParam->add(new Parameter('name1', '%'.$search[0].'%'));
                $skillConditionParam->add(new Parameter('name2', '%'.$search[1].'%'));
            }
            $query
                ->where($skillCondition)
                ->leftJoin('p.skills', 'ps')
                ->setParameters($skillConditionParam);
        }
        if ($isActive) {
            $query
                ->andWhere('p.isActive = true');
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @param int|null $id
     * @return mixed
     */
    public function getOne(?int $id)
    {
        return $this->partnerRepo->findOneBy(['id' => $id, 'isActive' => true]) ?: [];
    }

    /**
     * @param string $condition
     * @param array $skills
     *
     * @return string
     */
    private function getSkillsCondition(string $condition, array $skills): string
    {
        $i = 1;
        foreach ($skills as $skill) {
            $condition .= ' OR ps.skill = :param'.$i;
            $i ++;
        }

        return $condition;
    }

    /**
     * @param array $skills
     *
     * @return ArrayCollection
     */
    private function getSkillConditionParam(array $skills): ArrayCollection
    {
        $skillConditionParam = new ArrayCollection();

        $i = 1;
        foreach ($skills as $skill) {
            $skillConditionParam->add(new Parameter('param'.$i, $skill->getId()));
            $i ++;
        }

        return $skillConditionParam;
    }
}
