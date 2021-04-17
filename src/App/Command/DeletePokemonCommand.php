<?php

namespace App\App\Command;

use App\Domain\CQRS\CommandInterface;
use App\Domain\Entity\Pokemon;

/**
 * Class Command\DeletePokemonCommand
 */
final class DeletePokemonCommand implements CommandInterface
{
    public function __construct(protected Pokemon $originalPokemon)
    {
    }

    /** @var string */
    public function originalPokemon()
    {
        return $this->originalPokemon;
    }
}
