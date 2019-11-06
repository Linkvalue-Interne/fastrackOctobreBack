<?php

namespace App\Component;

use DateTime;

interface EntityInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime;

    /**
     * @param DateTime $dateTime
     *
     * @return EntityInterface
     */
    public function setCreatedAt(DateTime $dateTime): EntityInterface;

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime;

    /**
     * @param DateTime $dateTime
     *
     * @return EntityInterface
     */
    public function setUpdatedAt(DateTime $dateTime): EntityInterface;
}
