<?php

namespace App\Infra\MessengerBus;

use App\Domain\CQRS\CommandBusInterface;
use App\Domain\CQRS\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBusInterface
{
    protected MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
