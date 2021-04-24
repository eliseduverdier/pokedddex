<?php

namespace App\Domain\Entity;

use Symfony\Component\Uid\Uuid;

/**
 * Add an ID to objects
 */
trait IdTrait
{
    /** Uuid generated for the ORM */
    private $id;

    /** @return Uuid */
    public function getId(): Uuid
    {
        return $this->id;
    }
}
