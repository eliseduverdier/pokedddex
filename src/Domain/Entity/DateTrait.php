<?php

namespace App\Domain\Entity;

use DateTimeImmutable;

/**
 * Add creation and updating datetime to objects
 */
trait DateTrait
{
    protected DateTimeImmutable $createdAt;

    protected DateTimeImmutable $updatedAt;

    /** @return DateTimeImmutable */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /** @return self */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /** @return DateTimeImmutable */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /** @return self */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
