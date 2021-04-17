<?php

namespace App\App\Query;

use App\Domain\CQRS\QueryInterface;

final class GetPokemonQuery implements QueryInterface
{
    public function __construct(protected string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }
}
