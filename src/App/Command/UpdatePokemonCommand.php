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

    protected $number;
    protected $name;
    protected $type1;
    protected $type2;
    protected $total;
    protected $hp;
    protected $attack;
    protected $defense;
    protected $specialAttack;
    protected $specialDefense;
    protected $speed;
    protected $generation;
    protected $legendary;

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

    /** @return int */
    public function number()
    {
        return $this->number;
    }

    /** @return string */
    public function name()
    {
        return $this->name;
    }

    /** @return string */
    public function type1()
    {
        return $this->type1;
    }

    /** @return string */
    public function type2()
    {
        return $this->type2;
    }

    /** @return int */
    public function total()
    {
        return $this->total;
    }

    /** @return int */
    public function hp()
    {
        return $this->hp;
    }

    /** @return int */
    public function attack()
    {
        return $this->attack;
    }

    /** @return int */
    public function defense()
    {
        return $this->defense;
    }

    /** @return int */
    public function specialAttack()
    {
        return $this->specialAttack;
    }

    /** @return int */
    public function specialDefense()
    {
        return $this->specialDefense;
    }

    /** @return int */
    public function speed()
    {
        return $this->speed;
    }

    /** @return int */
    public function generation()
    {
        return $this->generation;
    }

    /** @return bool */
    public function legendary()
    {
        return $this->legendary;
    }
}
