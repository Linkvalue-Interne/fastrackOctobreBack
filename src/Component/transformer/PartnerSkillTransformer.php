<?php


namespace App\Component\transformer;

use App\Component\builder\SkillBuilder;
use App\Component\retrieveAll\PartnerSkillRetriever;
use App\Component\retrieveAll\SkillRetriever;

class PartnerSkillTransformer
{
    /** @var SkillBuilder  */
    private $skillBuilder;

    /** @var PartnerSkillRetriever  */
    private $partnerSkillRetriever;

    /** @var SkillRetriever  */
    private $skillRetriever;

    /**
     * PartnerSkillTransformer constructor.
     * @param SkillBuilder $skillBuilder
     * @param PartnerSkillRetriever $partnerSkillRetriever
     * @param SkillRetriever $skillRetriever
     */
    public function __construct(
        SkillBuilder $skillBuilder,
        PartnerSkillRetriever $partnerSkillRetriever,
        SkillRetriever $skillRetriever
    ) {
        $this->skillBuilder = $skillBuilder;
        $this->partnerSkillRetriever = $partnerSkillRetriever;
        $this->skillRetriever = $skillRetriever;
    }

    /**
     * @param array|null $data
     *
     * @return array
     */
    public function partnerSkillTransformer(?array $data): array
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
     * @param array|null $data
     *
     * @return array
     */
    public function favoriteSkillTransformer(?array $data): array
    {
        $result = [];

        foreach ($data as $item) {
            $skill = $this->skillRetriever->getOne($item['id']);

            $result[] = $skill;
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
