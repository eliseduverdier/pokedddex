<?php

namespace App\UI\Controller;

use App\App\Command\DeletePokemon as DeletePokemonCommand;
use App\Infra\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeletePokemon
 */
class DeletePokemon extends AbstractController
{
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository,
        protected DeletePokemonCommand $command
    ) {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(string $name): JsonResponse
    {
        $pokemon = $this->repository->findOneBy(['name' => $name]);
        if (is_null($pokemon)) {
            return $this->notFoundResponse($name);
        }

        $this->command->__invoke($pokemon);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
