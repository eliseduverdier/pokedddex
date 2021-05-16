<?php

namespace App\Infra\Serializer;

use App\App\Command\UpdatePokemonCommand;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UpdateCommandNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param UpdatePokemonCommand $command
     */
    public function normalize($command, string $format = null, array $context = []): array
    {
        return [
            'originalPokemon' => $command->originalPokemon,
            'number' => $command->number,
            'name' => $command->name,
            'type1' => $command->type1,
            'type2' => $command->type2,
            'total' => $command->total,
            'hp' => $command->hp,
            'attack' => $command->attack,
            'defense' => $command->defense,
            'specialAttack' => $command->specialAttack,
            'specialDefense' => $command->specialDefense,
            'speed' => $command->speed,
            'generation' => $command->generation,
            'legendary' => $command->legendary,
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof UpdatePokemonCommand;
    }

    public function denormalize($data, string $type, string $format = null, array $context = []): UpdatePokemonCommand
    {
        return new UpdatePokemonCommand(
            $data['originalPokemon'],
            $data['number'],
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
        return is_array($data) && isset($data['originalPokemon']);
    }
}
