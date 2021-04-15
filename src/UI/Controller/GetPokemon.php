<?php

namespace App\UI\Controller;

use App\Infra\Repository\PokemonRepository;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetPokemon
 */
class GetPokemon extends AbstractController
{
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository
    ) {
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(string $name): JsonResponse
    {
        $pokemon = $this->repository->findOneBy(['name' => $name]);
        return new JsonResponse(
            $this->serializer->serialize($pokemon, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
