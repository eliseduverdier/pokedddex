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

    /** @return int */
    public function getNumber(): int
    {
        return $this->number;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @return Type|null */
    public function getType1(): ?Type
    {
        return $this->type1;
    }

    /** @return string */
    public function getType1Name(): string
    {
        return $this->type1->getName();
    }

    /** @return Type|null */
    public function getType2(): ?Type
    {
        return $this->type2;
    }

    /** @return string|null */
    public function getType2Name(): ?string
    {
        return $this->type2
            ? $this->type2->getName()
            : '';
    }

    /** @return int */
    public function getTotal(): int
    {
        return $this->total;
    }

    /** @return int */
    public function getHp(): int
    {
        return $this->hp;
    }

    /** @return int */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /** @return int */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /** @return int */
    public function getSpecialAttack(): int
    {
        return $this->specialAttack;
    }

    /** @return int */
    public function getSpecialDefense(): int
    {
        return $this->specialDefense;
    }

    /** @return int */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /** @return int */
    public function getGeneration(): int
    {
        return $this->generation;
    }

    /** @return bool */
    public function getLegendary(): bool
    {
        return $this->legendary;
    }

    /** @return \DateTime */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /** @return \DateTime */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
