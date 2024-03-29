<?php

namespace App\Infra\Serializer;

use App\App\Command\DeletePokemonCommand;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DeleteCommandNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param DeletePokemonCommand $object
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            $object->pokemon
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof DeletePokemonCommand;
    }

    public function denormalize($data, string $type, string $format = null, array $context = []): DeletePokemonCommand
    {
        return new DeletePokemonCommand(
            $data['pokemon']
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return is_array($data);
    }
}
