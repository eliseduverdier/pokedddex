<?php

namespace App\UI\Controller;

use Assert\LazyAssertionException;
use Assert\InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractController 
{
    protected $serializer;

    // /** @var Logger */
    // protected $logger;

    public function __construct(
        //string $serializerConfigPath = '../resources/config/serializer/'
    )
    {
        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();

        $this->serializer = new Serializer([$normalizer], [$encoder]);
        // $this->serializer = SerializerBuilder::create()
        //     //->addMetadataDir($serializerConfigPath)
        //     ->build();
    }

    /**
     * Display details about errors in query or request data
     * @param mixed $errors
     */
    public function errorResponse($errors): JsonResponse
    {
        $output = [];

        if ($errors instanceof LazyAssertionException) {
            $status = Response::HTTP_BAD_REQUEST;
            $output = $this->buildErrorsArray($errors->getErrorExceptions());
        } elseif ($errors instanceof ConstraintViolationListInterface) {
            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
            $output = $this->buildErrorsArray($errors);
        } else {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $output = 'Unknown error';
            // TODO Error should be logged
        }

        return new JsonResponse([
            'errors' => $output
        ], $status);
    }

    public function notFoundResponse(string $input): JsonResponse
    {
        return new JsonResponse([
            'errors' => "Did not found entity $input",
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param array|ConstraintViolationListInterface $errors
     */
    private function buildErrorsArray($errors): array
    {
        $output = [];
        foreach ($errors as $error) {
            $output[$error->getPropertyPath()] = [
                'got' => $error->getValue(),
                'error' => $error->getMessage(),
            ];
        }
        return $output;
    }
}
