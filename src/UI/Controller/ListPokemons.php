<?php

namespace App\UI\Controller;

use App\App\Query\ListPokemons as QueryListPokemons;
use App\App\Query\ListPokemonsQuery;
use App\App\QueryHandler\ListPokemonsHandler;
use App\Domain\CQRS\QueryBusInterface;
use App\Infra\Repository\PokemonRepository;
use App\Infra\Repository\TypeRepository;
use Assert\Assert;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListPokemons
 */
class ListPokemons extends AbstractController
{
    public function __construct(
        protected PokemonRepository $pokemonRepository,
        protected TypeRepository $typeRepository,
        protected QueryBusInterface $queryBus
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $acceptedTypes = $this->typeRepository->getTypesName();
            $acceptedAttributes = $this->pokemonRepository->getAttributesName();

            Assert::lazy()
                ->that($request->query->get('type'), 'type')->nullOr()->string()->inArray($acceptedTypes)
                ->that($request->query->get('name'), 'name')->nullOr()->string()
                ->that($request->query->get('page'), 'page')->nullOr()->integerish()->greaterThan(0)
                ->that($request->query->get('sort'), 'sort', 'Should be an array (sort[attribute]=asc|desc)')
                ->nullOr()->isArray()
                ->verifyNow();

            $sortParams = $request->query->get('sort') ?? [];
            foreach ($sortParams as $key => $value) {
                Assert::lazy()
                    ->that($key)->inArray($acceptedAttributes)
                    ->that($value)->inArray(['asc', 'desc'])
                    ->verifyNow();
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        $pokemons = $this->queryBus->handle(new ListPokemonsQuery(
            $request->query->get('name'),
            $request->query->get('type'),
            $sortParams,
            (int) $request->query->get('page', '0')
        ));

        return new JsonResponse(
            $this->serializer->serialize($pokemons, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
