<?php

namespace App\App\QueryHandler;

use App\App\Query\ListTypesQuery;
use App\Domain\CQRS\QueryHandlerInterface;
use App\Infra\Repository\TypeRepository;

final class ListTypesHandler implements QueryHandlerInterface
{
    /**
     * @param TypeRepository $repository
     */
    public function __construct(
        protected TypeRepository $repository
    ) {
    }

    /**
     * @return array
     */
    public function __invoke(ListTypesQuery $query): array
    {
        return $this->repository->getTypesName();
    }
}
