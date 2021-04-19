<?php

namespace App\UI\Command;

use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadUserFixtures extends Command
{
    /** @var array */
    protected $exampleUsers = [
        'user1@example.com' => '1234567890',
        'user2@example.com' => '1234567890',
        'user3@example.com' => '1234567890',
    ];

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(
        protected EntityManagerInterface $em,
        protected UserPasswordEncoderInterface $passwordEncoder
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('pokedex:load:users')
            ->setDescription('Load the fixtures from the CSV to the DB.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
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

    /**
     * @param array $rows
     */
    protected function loadUsers()
    {
        foreach ($this->exampleUsers as $email => $password) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, $password)
            );
            $this->em->persist($user);
        }
        $this->em->flush();
    }
}
