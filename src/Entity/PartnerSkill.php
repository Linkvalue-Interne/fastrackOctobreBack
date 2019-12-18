<?php


namespace App\Entity;

class PartnerSkill implements EntityInterface, \JsonSerializable
{
    use EntityTrait;

    /** @var Partner */
    private $partner;

    /** @var Skill */
    private $skill;

    /** @var int */
    private $level;

    /**
     * @return Partner
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    /**
     * @param Partner $partner
     * @return PartnerSkill
     */
    public function setPartner(Partner $partner): PartnerSkill
    {
        $this->partner = $partner;
        return $this;
    }

    /**
     * @return Skill
     */
    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    /**
     * @param Skill $skill
     * @return PartnerSkill
     */
    public function setSkill(Skill $skill): PartnerSkill
    {
        $this->skill = $skill;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return PartnerSkill
     */
    public function setLevel(int $level): PartnerSkill
    {
        $this->level = $level;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getSkill()->getId(),
            'level' => $this->getLevel(),
        ];
    }
}
