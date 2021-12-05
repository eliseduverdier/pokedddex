<?php

namespace App\Domain\Entity;


/**
 * Class Pokemon
 */
class Pokemon
{
    use IdTrait;

    // TODO in construct, or as traits
    /** @var \DateTime */
    private $createdAt;

    /** @var \DateTime */
    private $updatedAt;

    public function __construct(
        private int $number,
        private string $name,
        private Type $type1,
        private ?Type $type2,
        private int $total,
        private int $hp,
        private int $attack,
        private int $defense,
        private int $specialAttack,
        private int $specialDefense,
        private int $speed,
        private int $generation,
        private bool $legendary
    ) {
        $this->setId();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function update(
        int $number,
        string $name,
        Type $type1,
        ?Type $type2,
        int $total,
        int $hp,
        int $attack,
        int $defense,
        int $specialAttack,
        int $specialDefense,
        int $speed,
        int $generation,
        bool $legendary
    ): void {
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
        $this->updatedAt = new \DateTime();
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType1(): Type
    {
        return $this->type1;
    }

    public function getType1Name(): string
    {
        return $this->type1->getName();
    }

    public function getType2(): ?Type
    {
        return $this->type2;
    }

    public function getType2Name(): ?string
    {
        return $this->type2
            ? $this->type2->getName()
            : '';
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function getSpecialAttack(): int
    {
        return $this->specialAttack;
    }

    public function getSpecialDefense(): int
    {
        return $this->specialDefense;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getGeneration(): int
    {
        return $this->generation;
    }

    public function getLegendary(): bool
    {
        return $this->legendary;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
