<?php

namespace App\UI\Controller;

use App\App\Command\UpdatePokemonCommand;
use App\App\Query\GetPokemonQuery;
use App\Domain\CQRS\QueryBusInterface;
use App\Domain\CQRS\CommandBusInterface;
use App\Domain\Entity\Pokemon as PokemonEntity;
use App\Infra\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UpdatePokemon
 */
class UpdatePokemon extends AbstractController
{
    public function __construct(
        protected PokemonRepository $repository,
        protected ValidatorInterface $validator,
        protected CommandBusInterface $commandBus,
        protected QueryBusInterface $queryBus
    ) {
        parent::__construct();
    }

    public function __invoke(string $name, Request $request): JsonResponse
    {
        $pokemon = $this->queryBus->handle(new GetPokemonQuery($name));
        if (is_null($pokemon)) {
            return $this->notFoundResponse($name);
        }

        $json = $request->getContent();
        /** @var UpdatePokemonCommand $pokemonCommand */
        $pokemonCommand = $this->serializer->deserialize($json, 'App\App\Command\UpdatePokemonCommand', 'json');
        $pokemonCommand->originalPokemon = $pokemon; // attach retreive entity to update it when dispatched
        $violations = $this->validator->validate($pokemonCommand);

        if (count($violations) > 0 && !$this->isSelfRenamed($violations, $pokemon, $pokemonCommand)) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $this->commandBus->dispatch($pokemonCommand);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * If the only violation is the name already existing, and it corresponds to the old one -> ignore it
     */
    protected function isSelfRenamed(
        ConstraintViolationListInterface $violations,
        PokemonEntity $pokemon,
        UpdatePokemonCommand $pokemonCommand
    ): bool {
        return count($violations) === 1
            && $violations[0]->getPropertyPath() === 'name'
            && strtolower($pokemon->getName()) === strtolower($pokemonCommand->name());
    }
}
