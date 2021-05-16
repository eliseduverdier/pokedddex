<?php

namespace App\App\Command;

use App\Domain\CQRS\CommandInterface;

final class CreatePokemonCommand implements CommandInterface
{
    public function __construct(
        public ?int $number,
        public string $name,
        public string $type1,
        public string $type2,
        public int $total,
        public int $hp,
        public int $attack,
        public int $defense,
        public int $specialAttack,
        public int $specialDefense,
        public int $speed,
        public int $generation,
        public bool $legendary,
    ) {
    }
}
