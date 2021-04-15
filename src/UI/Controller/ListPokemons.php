<?php

namespace App\UI\Controller;

use App\Infra\Repository\PokemonRepository;
use Assert\Assert;
use Assert\AssertionFailedException;
use AssertionError;
use Exception;
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
        try {
            $acceptedTypes = $this->repository->getTypesName();
            $acceptedAttributes = $this->repository->getAttributesName();

            Assert::lazy()
                ->that($request->query->get('type'))->nullOr()->string()->inArray($acceptedTypes)
                ->that($request->query->get('name'))->nullOr()->string()
                ->that($request->query->get('page'))->nullOr()->integer()->greaterThan(0)
                ->verifyNow();

            $sortParams = $request->query->get('sort', []);
            foreach ($sortParams as $key => $value) {
                Assert::lazy()
                    ->that($key)->inArray($acceptedAttributes)
                    ->that($value)->inArray(['asc', 'desc'])
                    ->verifyNow();
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

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
