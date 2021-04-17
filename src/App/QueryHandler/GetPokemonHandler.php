<?php

namespace App\App\QueryHandler;

use App\App\Query\GetPokemonQuery;
use App\Domain\CQRS\QueryHandlerInterface;
use App\Domain\Entity\Pokemon;
use App\Infra\Repository\PokemonRepository;

/**
 * Command GetPokemon Query
 */
final class GetPokemonHandler implements QueryHandlerInterface
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
    public function __invoke(GetPokemonQuery $query): ?Pokemon
    {
        return $this->repository->findOneBy(['name' => $query->name()]);
    }
}
