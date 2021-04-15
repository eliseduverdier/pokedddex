<?php

namespace App\UI\Controller;

use Assert\AssertionFailedException;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()
            ->addMetadataDir('../resources/config/serializer/')
            ->build();
    }

    public function errorResponse($errors)
    {
        $output = [];
        foreach ($errors->getErrorExceptions() as $error) {
            $output[] = [
                'got' => $error->getValue(),
                'error' => $error->getMessage(),
            ];
        }
        return new JsonResponse([
            'errors' => $output
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function notFoundResponse($input)
    {
        return new JsonResponse([
            'errors' => "Did not found entity $input",
        ], Response::HTTP_NOT_FOUND);
    }
}
