<?php

namespace App\UI\Controller;

use App\App\Command\DeletePokemonCommand;
use App\App\Query\GetPokemonQuery;
use App\Domain\CQRS\QueryBusInterface;
use App\Domain\CQRS\CommandBusInterface;
use App\Infra\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeletePokemon
 */
class DeletePokemon extends AbstractController
{
    public function __construct(
        protected PokemonRepository $repository,
        protected CommandBusInterface $commandBus,
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

        $this->commandBus->dispatch(new DeletePokemonCommand($pokemon));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
