<?php

namespace App\App\Query;

use App\Infra\Repository\PokemonRepository;

class ListPokemons
{
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository
    ) {
    }

    /**
     * @return array
     */
    public function __invoke(
        $name,
        $type,
        $sort,
        $page
    ): array {

        $search = [];
        if (!is_null($name)) {
            $search['name'] = $name;
        }
        if (!is_null($type)) {
            $search['type'] = $type;
        }

        return $this->repository->filterBy(
            $search,
            $sort,
            $page
        );
    }
}
