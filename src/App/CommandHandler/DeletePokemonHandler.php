<?php

namespace App\App\CommandHandler;

use App\App\Command\DeletePokemonCommand;
use App\Domain\CQRS\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DeletePokemonHandler implements CommandHandlerInterface
{
    public function __construct(
        protected EntityManagerInterface $em,
    ) {
    }

    public function __invoke(DeletePokemonCommand $command)
    {
        $this->em->remove($command->originalPokemon());
        $this->em->flush();
    }
}
