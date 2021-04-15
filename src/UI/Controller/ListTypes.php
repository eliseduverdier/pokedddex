<?php

namespace App\UI\Controller;

use App\Infra\Repository\TypeRepository;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListTypes
 */
class ListTypes extends AbstractController
{
    /**
     * @param TypeRepository $repository
     */
    public function __construct(
        protected TypeRepository $repository
    ) {
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $types = $this->repository->findAll();
        return new JsonResponse(
            $this->serializer->serialize($types, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
