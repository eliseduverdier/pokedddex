<?php

namespace App\Domain\Entity;

use Symfony\Component\Uid\Uuid;

trait IdTrait
{
    private $id;

    public function setId(): void
    {
        $this->id = (Uuid::v4())->toRfc4122();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
