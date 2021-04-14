<?php

namespace App\Domain\Entity;

use DateTimeImmutable;

class Type
{
    use IdTrait;
    use DateTrait;

    public function __construct(protected string $name)
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }
}
