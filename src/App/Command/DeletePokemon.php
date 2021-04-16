<?php

namespace App\App\Command;

use App\Domain\Entity\Pokemon;
use App\Domain\Payload\Pokemon as PayloadPokemon;
use App\Infra\Repository\TypeRepository;
use App\Infra\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeletePokemon
{
    public function __construct(
        protected EntityManagerInterface $em,
    ) {
        return;
    }
    public function __invoke(Pokemon $pokemon)
    {
        $this->em->remove($pokemon);
        $this->em->flush();
    }
}
