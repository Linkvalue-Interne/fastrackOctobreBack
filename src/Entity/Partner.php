<?php

namespace App\Entity;

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
}
