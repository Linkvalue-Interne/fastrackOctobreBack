<?php

namespace App\Entity;


class Partner
{
    /** @var int */
    private $id;

    /** @var string */
    private $firstname;

    /** @var string */
    private $lastname;

    /** @var string */
    private $job;

    /** @var string */
    private $email;

    /** @var string */
    private $phone_number;

    /** @var int */
    private $experience;

    /** @var string */
    private $customer;

    /** @var string */
    private $project;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Partner
     */
    public function setFirstname(string $firstname): Partner
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Partner
     */
    public function setLastname(string $lastname): Partner
    {
        $this->lastname = $lastname;

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
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     * @return Partner
     */
    public function setPhoneNumber(string $phone_number): Partner
    {
        $this->phone_number = $phone_number;

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
