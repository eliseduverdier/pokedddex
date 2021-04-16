<?php

namespace App\UI\Controller;

use App\App\Command\CreatePokemon as CreatePokemonCommand;
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
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository,
        protected ValidatorInterface $validator,
        protected CreatePokemonCommand $command
    ) {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $json = $request->getContent();
        $payload = $this->serializer->deserialize($json, 'App\Domain\Payload\Pokemon', 'json');
        $violations = $this->validator->validate($payload);
        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $name = $this->command->__invoke($payload);

        return new JsonResponse(null, Response::HTTP_CREATED, ['Location' => "/pokemon/$name"]);
    }
}
