<?php

namespace App\Infra\Serializer;

use App\App\Command\CreatePokemonCommand;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CreateCommandNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param CreatePokemonCommand $object
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'number' => $object->number,
            'name' => $object->name,
            'type1' => $object->type1,
            'type2' => $object->type2,
            'total' => $object->total,
            'hp' => $object->hp,
            'attack' => $object->attack,
            'defense' => $object->defense,
            'specialAttack' => $object->specialAttack,
            'specialDefense' => $object->specialDefense,
            'speed' => $object->speed,
            'generation' => $object->generation,
            'legendary' => $object->legendary,
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof CreatePokemonCommand;
    }

    public function denormalize($data, string $type, string $format = null, array $context = []): CreatePokemonCommand
    {
        return new CreatePokemonCommand(
            isset($data['number']) ? $data['number'] : null,
            $data['name'],
            $data['type1'],
            $data['type2'],
            $data['total'],
            $data['hp'],
            $data['attack'],
            $data['defense'],
            $data['special_attack'],
            $data['special_defense'],
            $data['speed'],
            $data['generation'],
            $data['legendary'],
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return is_array($data);
    }
}
