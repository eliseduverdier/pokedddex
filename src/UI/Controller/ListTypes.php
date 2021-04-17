<?php

namespace App\UI\Controller;

use App\App\Query\ListTypes as ListTypesQuery;
use App\Infra\Repository\TypeRepository;
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
        protected ListTypesQuery $listTypeQuery
    ) {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $types = $this->listTypeQuery->__invoke();

        return new JsonResponse(
            $this->serializer->serialize($types, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
