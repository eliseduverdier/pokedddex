<?php

namespace App\App\Query;

use App\Domain\CQRS\QueryInterface;

final class GetPokemonQuery implements QueryInterface
{
    public function __construct(public string $name)
    {
    }
}
