<?php

namespace App\Infra\Serializer;

use App\Domain\Entity\Pokemon;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class PokemonNormalizer implements NormalizerInterface
{
    /**
     * @param Pokemon $pokemon
     */
    public function normalize($pokemon, string $format = null, array $context = []): array
    {
        return [
            // basic info
            'number' => $pokemon->getNumber(),
            'name' => $pokemon->getName(),
            'legendary' => $pokemon->getLegendary(),

            // relation
            'type1' => $pokemon->getType1()->getName(),
            'type2' => $pokemon->getType2() ? $pokemon->getType2()->getName() : null,

            // stats
            'total' => $pokemon->getTotal(),
            'hp' => $pokemon->getHp(),
            'attack' => $pokemon->getAttack(),
            'defense' => $pokemon->getDefense(),
            'specialAttack' => $pokemon->getSpecialAttack(),
            'specialDefense' => $pokemon->getSpecialDefense(),
            'speed' => $pokemon->getSpeed(),
            'generation' => $pokemon->getGeneration(),

            // metadata
            'createdAt' => $pokemon->getCreatedAt()->format('Y-m-d'),
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Pokemon;
    }
}
