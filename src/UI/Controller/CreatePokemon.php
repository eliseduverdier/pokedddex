<?php

namespace App\UI\Controller;

use App\App\Command\CreatePokemonCommand;
use App\Domain\CQRS\CommandBusInterface;
use App\Infra\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreatePokemon
 */
class CreatePokemon extends AbstractController
{
    public function __construct(
        protected PokemonRepository $repository,
        protected ValidatorInterface $validator,
        protected CommandBusInterface $commandBus
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var CreatePokemonCommand $pokemonCommand */
        $pokemonCommand = $this->serializer->deserialize($json, 'App\App\Command\CreatePokemonCommand', 'json');

        $violations = $this->validator->validate($pokemonCommand);
        if (count($violations) > 0) {
            return $this->errorResponse($violations);
        }

        $this->commandBus->dispatch($pokemonCommand);

        return new JsonResponse(null, Response::HTTP_CREATED, ['Location' => "/pokemon/{$pokemonCommand->name()}"]);
    }
}
