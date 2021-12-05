<?php

namespace App\App\QueryHandler;

use App\App\Query\ListPokemonsQuery;
use App\Domain\CQRS\QueryHandlerInterface;
use App\Infra\Repository\PokemonRepository;

final class ListPokemonsHandler implements QueryHandlerInterface
{
    public function __construct(
        protected PokemonRepository $repository
    ) {
    }

    public function __invoke(ListPokemonsQuery $query): array
    {
        $search = [];
        if (!is_null($query->name)) {
            $search['name'] = $query->name;
        }
        if (!is_null($query->type)) {
            $search['type'] = $query->type;
        }

        return $this->repository->filterBy(
            $search,
            $query->sort,
            $query->page
        );
    }
}
