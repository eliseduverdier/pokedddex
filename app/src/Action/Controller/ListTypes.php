<?php

namespace App\Action\Controller;

use App\App\Query\ListTypesQuery;
use App\Domain\CQRS\QueryBusInterface;
use App\Infra\Repository\TypeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ListTypes extends AbstractController
{
    public function __construct(
        protected QueryBusInterface $queryBus,
        protected SerializerInterface $serializer
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $types = $this->queryBus->handle(new ListTypesQuery());

        return new JsonResponse(
            $this->serializer->serialize($types, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
