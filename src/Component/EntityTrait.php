<?php

namespace App\Component;

use DateTime;

trait EntityTrait
{
    /** @var int */
    private $id;

    /** @var DateTime */
    private $createdAt;

    /** @var DateTime */
    private $updatedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $dateTime
     *
     * @return EntityInterface
     */
    public function setCreatedAt(DateTime $dateTime): EntityInterface
    {
        $this->createdAt = $dateTime;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $dateTime
     *
     * @return EntityInterface
     */
    public function setUpdatedAt(DateTime $dateTime): EntityInterface
    {
        $this->updatedAt = $dateTime;

        return $this;
    }
}
