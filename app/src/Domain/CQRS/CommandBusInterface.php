<?php

namespace App\Domain\CQRS;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
