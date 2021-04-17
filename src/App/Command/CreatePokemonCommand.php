<?php

namespace App\App\Command;

use App\Domain\CQRS\CommandBusInterface;
use App\Domain\CQRS\CommandInterface;

/**
 * Class Command\Pokemon
 * Used to validate input when creating or updating a Entity\Pokemon
 */
final class CreatePokemonCommand implements CommandInterface
{
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

    /** @var int */
    public function number()
    {
        return $this->number;
    }

    /** @var string */
    public function name()
    {
        return $this->name;
    }

    /** @var string */
    public function type1()
    {
        return $this->type1;
    }

    /** @var string */
    public function type2()
    {
        return $this->type2;
    }

    /** @var int */
    public function total()
    {
        return $this->total;
    }

    /** @var int */
    public function hp()
    {
        return $this->hp;
    }

    /** @var int */
    public function attack()
    {
        return $this->attack;
    }

    /** @var int */
    public function defense()
    {
        return $this->defense;
    }

    /** @var int */
    public function specialAttack()
    {
        return $this->specialAttack;
    }

    /** @var int */
    public function specialDefense()
    {
        return $this->specialDefense;
    }

    /** @var int */
    public function speed()
    {
        return $this->speed;
    }

    /** @var int */
    public function generation()
    {
        return $this->generation;
    }

    /** @var bool */
    public function legendary()
    {
        return $this->legendary;
    }
}
