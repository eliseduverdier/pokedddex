<?php

namespace App\App\Query;

use App\Domain\Entity\Pokemon;
use App\Infra\Repository\PokemonRepository;

/**
 * Command GetPokemon Query
 */
class GetPokemon
{
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository
    ) {
    }

    /**
     * @return Pokemon|null
     */
    public function __invoke(string $name): ?Pokemon
    {
        return $this->repository->findOneBy(['name' => $name]);
    }
}
