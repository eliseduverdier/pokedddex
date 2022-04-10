<?php

namespace App\Action\Command;

use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoadUserFixtures extends Command
{
    protected array $exampleUsers = [
        'user1@example.com' => '1234567890',
        'user2@example.com' => '1234567890',
        'user3@example.com' => '1234567890',
    ];

    public function __construct(
        protected EntityManagerInterface $em,
        protected UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('pokedex:load:users')
            ->setDescription('Load some users in the DB.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->loadUsers();

            $output->writeln(sprintf('Successfully loaded %d user fixtures !', count($this->exampleUsers)));

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("Error: {$e->getMessage()}");

            return Command::FAILURE;
        }
    }

    protected function loadUsers(): void
    {
        foreach ($this->exampleUsers as $email => $password) {
            $user = new User();
            $user->setId();
            $user->setUsername($email);
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $password)
            );
            $this->em->persist($user);
        }
        $this->em->flush();
    }
}
