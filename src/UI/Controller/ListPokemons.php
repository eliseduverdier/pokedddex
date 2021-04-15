<?php

namespace App\UI\Controller;

use App\Infra\Repository\PokemonRepository;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListPokemons
 */
class ListPokemons extends AbstractController
{
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository
    ) {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        // TODO asserts
        // sort = key in attributes, value in asc|desc
        // name = textual
        // type = is in list 
        // page = positive int

        $searchParams = [];

        // TODO refacto with Infra\Search class
        if (!is_null($request->query->get('name'))) {
            $searchParams['name'] = $request->query->get('name');
        }
        if (!is_null($request->query->get('type'))) {
            $searchParams['type'] = $request->query->get('type');
            // if (!array_key_exists($typeFilter, [...all types])) { throw }
        }

        $pokemons = $this->repository->filterBy(
            $searchParams,
            $request->query->get('sort', []),
            $request->query->get('page', 0)
        );

        return new JsonResponse(
            $this->serializer->serialize($pokemons, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
