<?php

namespace App\UI\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 
 */
class GetTypes
{
    /**
     * 
     */
    public function number(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
