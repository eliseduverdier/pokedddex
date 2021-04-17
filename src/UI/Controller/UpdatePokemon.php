<?php

namespace App\UI\Controller;

use App\App\Command\UpdatePokemon as UpdatePokemonCommand;
use App\Domain\Entity\Pokemon as PokemonEntity;
use App\Domain\Payload\Pokemon as PokemonPayload;
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
    /**
     * @param PokemonRepository $repository
     */
    public function __construct(
        protected PokemonRepository $repository,
        protected ValidatorInterface $validator,
        protected UpdatePokemonCommand $command
    ) {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(string $name, Request $request): JsonResponse
    {
        $pokemon = $this->repository->findOneBy(['name' => $name]);
        if (is_null($pokemon)) {
            return $this->notFoundResponse($name);
        }

        $json = $request->getContent();
        $payload = $this->serializer->deserialize($json, 'App\Domain\Payload\Pokemon', 'json');
        $violations = $this->validator->validate($payload);
        if (count($violations) > 0 && !$this->isSelfRenamed($violations, $pokemon, $payload)) {
            // if the only violation is the name already existing, and it corresponds to the old one -> ignore
            $errors = [];
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $name = $this->command->__invoke($pokemon, $payload);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param ConstraintViolationListInterface $violations
     * @param PokemonEntity $pokemon
     * @param PokemonPayload $payload
     * @return bool
     */
    protected function isSelfRenamed(ConstraintViolationListInterface $violations, PokemonEntity $pokemon, PokemonPayload $payload)
    {
        return count($violations) === 1
            && $violations[0]->getPropertyPath() === 'name'
            && strtolower($pokemon->getName()) === strtolower($payload->getName());
    }
}
