<?php

namespace App\UI\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{types}", name="app_lucky_number")
 */
class ListPokemons
{
    /**
     * @Route("/{types}", name="app_lucky_number")
     */
    public function __invoke(int $max): JsonResponse
    {

        return new JsonResponse();
    }
}
