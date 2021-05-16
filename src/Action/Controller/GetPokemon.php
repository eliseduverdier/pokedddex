<?php

namespace App\Action\Controller;

use App\App\Query\GetPokemonQuery;
use App\Domain\CQRS\QueryBusInterface;
use App\Infra\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPokemon extends AbstractController
{
    public function __construct(
        protected QueryBusInterface $queryBus
    ) {
        parent::__construct();
    }

    public function __invoke(string $name): JsonResponse
    {
        $pokemon = $this->queryBus->handle(new GetPokemonQuery($name));

        if (is_null($pokemon)) {
            return $this->notFoundResponse($name);
        }

        return new JsonResponse(
            $this->serializer->serialize($pokemon, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
