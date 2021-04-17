<?php

namespace App\App\Query;

use App\Infra\Repository\TypeRepository;

class ListTypes
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
    public function __invoke(): array
    {
        return $this->repository->getTypesName();
    }
}
