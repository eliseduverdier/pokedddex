<?php

namespace App\Domain\Entity;

use DateTimeImmutable;

class Pokemon
{
    use IdTrait;
    use DateTrait;

    public function __construct(
        protected string $name,
        protected ?Type $type1,
        protected ?Type $type2,
        protected int $total,
        protected int $hp,
        protected int $attack,
        protected int $defense,
        protected int $specialAttack,
        protected int $specialDefense,
        protected int $speed,
        protected int $generation,
        protected bool $legendary
    ) {
        $this->legendary = $legendary === 'True'; // map to boolean
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
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

    /** @return Type|null */
    public function getType2(): ?Type
    {
        return $this->type2;
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


    /** @return self */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /** @return self */
    public function setType1(?Type $type1): self
    {
        $this->type1 = $type1;
        return $this;
    }

    /** @return self */
    public function setType2(?Type $type2): self
    {
        $this->type2 = $type2;
        return $this;
    }

    /** @return self*/
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }

    /** @return self*/
    public function setHp(int $hp): self
    {
        $this->hp = $hp;
        return $this;
    }

    /** @return self*/
    public function setAttack(int $attack): self
    {
        $this->attack = $attack;
        return $this;
    }

    /** @return self*/
    public function setDefense(int $defense): self
    {
        $this->defense = $defense;
        return $this;
    }

    /** @return self*/
    public function setSpecialAttack(int $specialAttack): self
    {
        $this->specialAttack = $specialAttack;
        return $this;
    }

    /** @return self*/
    public function setSpecialDefense(int $specialDefense): self
    {
        $this->specialDefense = $specialDefense;
        return $this;
    }

    /** @return self*/
    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;
        return $this;
    }

    /** @return self*/
    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;
        return $this;
    }

    /** @return self */
    public function setLegendary(bool $legendary): self
    {
        $this->legendary = $legendary;
        return $this;
    }
}
