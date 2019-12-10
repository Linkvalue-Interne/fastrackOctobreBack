<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Partner implements EntityInterface
{
    use EntityTrait;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $job;

    /** @var string */
    private $email;

    /** @var string */
    private $phoneNumber;

    /** @var int */
    private $experience;

    /** @var string */
    private $customer;

    /** @var string */
    private $project;

    /** @var bool */
    private $isActive = 1;

    /** @var string */
    private $avatar = 'default.jpg';

    /** @var ArrayCollection */
    private $skills;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * @param PartnerSkill $skill
     * @return Partner
     */
    public function addSkill(PartnerSkill $skill): Partner
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    /**
     * @param PartnerSkill $skill
     * @return $this
     */
    public function removeSkill(PartnerSkill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Partner
     */
    public function setFirstName(string $firstName): Partner
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Partner
     */
    public function setLastName(string $lastName): Partner
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getJob(): ?string
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return Partner
     */
    public function setJob(string $job): Partner
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Partner
     */
    public function setEmail(string $email): Partner
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return Partner
     */
    public function setPhoneNumber(string $phoneNumber): Partner
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExperience(): ?int
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     * @return Partner
     */
    public function setExperience(int $experience): Partner
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     * @return Partner
     */
    public function setCustomer(string $customer): Partner
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProject(): ?string
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return Partner
     */
    public function setProject(string $project): Partner
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return Partner
     */
    public function setIsActive(bool $isActive): Partner
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return Partner
     */
    public function setAvatar(string $avatar): Partner
    {
        $this->avatar = $avatar;

        return $this;
    }
}
