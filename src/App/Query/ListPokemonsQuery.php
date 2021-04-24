<?php

namespace App\App\Query;

use App\Domain\CQRS\QueryInterface;

final class ListPokemonsQuery implements QueryInterface
{
    public function __construct(
        public ?string $name,
        public ?string $type,
        public ?array $sort,
        public ?int $page
    ) {
    }
}
