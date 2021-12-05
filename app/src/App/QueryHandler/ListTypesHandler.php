<?php

namespace App\App\QueryHandler;

use App\App\Query\ListTypesQuery;
use App\Domain\CQRS\QueryHandlerInterface;
use App\Infra\Repository\TypeRepository;

final class ListTypesHandler implements QueryHandlerInterface
{
    public function __construct(
        protected TypeRepository $repository
    ) {
    }

    public function __invoke(ListTypesQuery $query): array
    {
        return $this->repository->getTypesName();
    }
}
