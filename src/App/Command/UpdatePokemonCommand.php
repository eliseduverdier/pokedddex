<?php

namespace App\App\Command;

use App\Domain\CQRS\CommandInterface;

/**
 * Class Command\Pokemon
 * Used to validate input when creating or updating a Entity\Pokemon
 */
final class UpdatePokemonCommand implements CommandInterface
{
    /** @var \App\Domain\Entity\Pokemon */
    public $originalPokemon;

    public $number;
    public $name;
    public $type1;
    public $type2;
    public $total;
    public $hp;
    public $attack;
    public $defense;
    public $specialAttack;
    public $specialDefense;
    public $speed;
    public $generation;
    public $legendary;

    public function __construct(
        int $number,
        string $name,
        string $type1,
        string $type2,
        int $total,
        int $hp,
        int $attack,
        int $defense,
        int $specialAttack,
        int $specialDefense,
        int $speed,
        int $generation,
        bool $legendary,
    ) {
        $this->number = $number;
        $this->name = $name;
        $this->type1 = $type1;
        $this->type2 = $type2;
        $this->total = $total;
        $this->hp = $hp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->specialAttack = $specialAttack;
        $this->specialDefense = $specialDefense;
        $this->speed = $speed;
        $this->generation = $generation;
        $this->legendary = $legendary;
    }
}
