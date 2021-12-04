<?php

namespace App\Domain\Entity;

/**
 * Class Type
 */
class Type
{
    use IdTrait;

    /** @var string */
    public $name;

    /** @var \DateTime */
    public $createdAt;

    /** @var \DateTime */
    public $updatedAt;

    public function __construct(string $name)
    {
        $this->setId();
        $this->name = $name;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /** @return \DateTime */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /** @return \DateTime */
    public function getUpdatedAt(): ?\DateTime
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
}
