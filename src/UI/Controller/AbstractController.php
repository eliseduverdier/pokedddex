<?php

namespace App\UI\Controller;

use Assert\LazyAssertionException;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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

        if ($errors instanceof LazyAssertionException) {
            $status = Response::HTTP_BAD_REQUEST;
            foreach ($errors->getErrorExceptions() as $error) {
                $output[$error->getPropertyPath()] = [
                    'got' => $error->getValue(),
                    'error' => $error->getMessage(),
                ];
            }
        } elseif ($errors instanceof ConstraintViolationListInterface) {
            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
            foreach ($errors as $violation) {
                $output[$violation->getPropertyPath()] = $violation->getMessage();
            }
        } else {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $output = 'Unknown error';
        }
        return new JsonResponse([
            'errors' => $output
        ], $status);
    }

    public function notFoundResponse($input)
    {
        return new JsonResponse([
            'errors' => "Did not found entity $input",
        ], Response::HTTP_NOT_FOUND);
    }
}
