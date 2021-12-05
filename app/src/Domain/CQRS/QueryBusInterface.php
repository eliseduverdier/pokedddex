<?php

namespace App\Domain\CQRS;

interface QueryBusInterface
{
    /** @return mixed */
    public function handle(QueryInterface $query);
}
