<?php

namespace App\Domain\Entity;

use DateTime;

class Type
{
    use IdTrait;

    protected $name;
    protected $createdAt;
    protected $updatedAt;

    public function __construct(
        string $name,
        ?DateTime $createdAt,
        ?DateTime $updatedAt,
    ) {
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /** @return string */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /** @return string */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /** @return self */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /** @return self */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
