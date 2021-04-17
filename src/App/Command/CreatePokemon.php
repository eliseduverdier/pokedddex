<?php

namespace App\App\Command;

use App\Domain\Entity\Pokemon;
use App\Domain\Payload\Pokemon as PayloadPokemon;
use App\Infra\Repository\TypeRepository;
use App\Infra\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreatePokemon
{
    public function __construct(
        protected EntityManagerInterface $em,
        protected TypeRepository $typeRepository,
        protected PokemonRepository $pokemonRepository
    ) {
        return;
    }
    public function __invoke(PayloadPokemon $payload)
    {
        $pokemon = new Pokemon(
            $payload->getNumber() ?? $this->pokemonRepository->getNewNumber(),
            $payload->getName(),
            $this->typeRepository->findOneBy(['name' => $payload->getType1()]),
            $this->typeRepository->findOneBy(['name' => $payload->getType2()]),
            $payload->getTotal(),
            $payload->getHp(),
            $payload->getAttack(),
            $payload->getDefense(),
            $payload->getSpecialAttack(),
            $payload->getSpecialDefense(),
            $payload->getSpeed(),
            $payload->getGeneration(),
            $payload->getLegendary()
        );
        $this->em->persist($pokemon);
        $this->em->flush();
        return $pokemon->getName();
    }
}
