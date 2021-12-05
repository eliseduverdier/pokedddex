<?php

namespace App\Infra\Serializer;

use App\Domain\Entity\Pokemon;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class PokemonNormalizer implements NormalizerInterface
{
    /**
     * @param Pokemon $object
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            // basic info
            'number' => $object->getNumber(),
            'name' => $object->getName(),
            'legendary' => $object->getLegendary(),

            // relation
            'type1' => $object->getType1()->getName(),
            'type2' => $object->getType2() ? $object->getType2()?->getName() : null,

            // stats
            'total' => $object->getTotal(),
            'hp' => $object->getHp(),
            'attack' => $object->getAttack(),
            'defense' => $object->getDefense(),
            'specialAttack' => $object->getSpecialAttack(),
            'specialDefense' => $object->getSpecialDefense(),
            'speed' => $object->getSpeed(),
            'generation' => $object->getGeneration(),

            // metadata
            'createdAt' => $object->getCreatedAt()->format('Y-m-d'),
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Pokemon;
    }
}
