<?php


namespace App\Component\transformer;

use App\Component\builder\SkillBuilder;
use App\Component\retrieveAll\PartnerSkillRetriever;

class PartnerSkillTransformer
{
    /** @var SkillBuilder  */
    private $skillBuilder;

    /** @var PartnerSkillRetriever  */
    private $partnerSkillRetriever;

    public function __construct(SkillBuilder $skillBuilder, PartnerSkillRetriever $partnerSkillRetriever)
    {
        $this->skillBuilder = $skillBuilder;
        $this->partnerSkillRetriever = $partnerSkillRetriever;
    }

    public function transformer(?array $data): array
    {
        $result = [];

        foreach ($data['skills'] as $item) {
            $partnerSkill = $this->search($item['id'], $this->partnerSkillRetriever->getAll($data['id']));

            if (null == $partnerSkill) {
                $result [] = $this->skillBuilder
                    ->buildPartnerSkill(
                        $data['id'],
                        $item['id'],
                        $item['level']
                    );
                continue;
            }

            if ($partnerSkill->getLevel() !== $item['level']) {
                $result [] = $partnerSkill->setLevel($item['level']);
            }
        }

        return $result;
    }

    /**
     * @param int $skillId
     * @param array $data
     * @return mixed|null
     */
    public function search(int $skillId, ?array $data)
    {
        if (!empty($data)) {
            foreach ($data as $item) {
                if ($skillId === $item->getSkill()->getId()) {
                    return $item;
                }
            }
        }

        return null;
    }
}
