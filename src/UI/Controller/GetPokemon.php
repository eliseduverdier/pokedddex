<?php

namespace App\UI\Controller;

use App\Infra\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetPokemon
 */
class GetPokemon extends AbstractController
{
    public function __construct(
        protected PokemonRepository $repository
    ) {
        parent::__construct();
    }

    public function __invoke(string $name): JsonResponse
    {
        $pokemon = $this->repository->findOneBy(['name' => $name]);

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
