<?php

namespace App\UI\Controller;

use App\Infra\Repository\PokemonRepository;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListPokemons
 */
class ListPokemons
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
    public function __invoke(): JsonResponse
    {
        $serializer = SerializerBuilder::create()->build();

        $pokemons = $this->repository->findAll();
        return new JsonResponse(
            $serializer->serialize($pokemons, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}