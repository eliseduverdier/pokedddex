<?php

namespace App\Infra\Normalizer;

use App\Domain\Entity\Pokemon;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class PokemonNormalizer implements NormalizerInterface //, SerializerInterface
{

    public function __construct(
        private SerializerInterface $serializer
    ) {
    }


    // public function serialize($pokemon, string $format = null, array $context = [])
    // {
    //     $data = $this->serializer->serialize($pokemon, $format, $context);
    //     dump($data);
    //     die;

    //     return $data;
    // }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Pokemon;
    }
}
