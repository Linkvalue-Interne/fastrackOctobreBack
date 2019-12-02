<?php


namespace App\Entity;

class Category implements EntityInterface
{
    use EntityTrait;

    /** @var string */
    private $name;

    /** @var int */
    private $skillId;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSkillId(): ?int
    {
        return $this->skillId;
    }

    /**
     * @param int $skillId
     * @return Category
     */
    public function setSkillId(int $skillId): Category
    {
        $this->skillId = $skillId;

        return $this;
    }
}
