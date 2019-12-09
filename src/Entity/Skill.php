<?php


namespace App\Entity;

class Skill implements EntityInterface
{
    use EntityTrait;

    /** @var string */
    private $name;

    /** @var string */
    private $icon;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Skill
     */
    public function setName($name): Skill
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     * @return Skill
     */
    public function setIcon($icon): Skill
    {
        $this->icon = $icon;
        return $this;
    }
}
