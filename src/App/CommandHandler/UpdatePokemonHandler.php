<?php

namespace App\App\CommandHandler;

use App\App\Command\UpdatePokemonCommand;
use App\Domain\CQRS\CommandHandlerInterface;
use App\Domain\Entity\Pokemon;
use App\Infra\Repository\TypeRepository;
use App\Infra\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;

final class UpdatePokemonHandler implements CommandHandlerInterface
{
    public function __construct(
        protected EntityManagerInterface $em,
        protected TypeRepository $typeRepository,
        protected PokemonRepository $pokemonRepository
    ) {
    }

    public function __invoke(UpdatePokemonCommand $command)
    {
        $originalPokemon = $command->originalPokemon;

        $originalPokemon->update(
            $command->number ?? $originalPokemon->getNumber(),
            $command->name,
            $this->typeRepository->findOneBy(['name' => $command->type1]),
            $this->typeRepository->findOneBy(['name' => $command->type2]),
            $command->total,
            $command->hp,
            $command->attack,
            $command->defense,
            $command->specialAttack,
            $command->specialDefense,
            $command->speed,
            $command->generation,
            $command->legendary,
        );
        $this->em->persist($originalPokemon);
        $this->em->flush();
    }
}
