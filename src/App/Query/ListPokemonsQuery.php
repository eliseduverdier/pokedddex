<?php

namespace App\App\Query;

use App\Domain\CQRS\QueryInterface;

final class ListPokemonsQuery implements QueryInterface
{
    public function __construct(
        protected ?string $name,
        protected ?string $type,
        protected ?array $sort,
        protected ?int $page
    ) {
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function sort(): ?array
    {
        return $this->sort;
    }

    public function page(): ?int
    {
        return $this->page;
    }
}
