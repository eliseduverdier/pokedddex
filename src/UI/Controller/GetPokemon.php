<?php

namespace App\UI\Controller;

use App\Infra\Repository\PokemonRepository;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetPokemon
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
     * @return JsonResponse
     */
    public function __invoke(string $name): JsonResponse
    {
        $serializer = SerializerBuilder::create()->build();

        $pokemon = $this->repository->findOneBy(['name' => $name]);
        return new JsonResponse(
            $serializer->serialize($pokemon, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
