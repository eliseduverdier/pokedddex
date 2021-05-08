<?php

namespace App\App\Command;

use App\Domain\CQRS\CommandInterface;
use App\Domain\Entity\Pokemon;

final class DeletePokemonCommand implements CommandInterface
{
    public function __construct(public Pokemon $pokemon)
    {
    }
}
