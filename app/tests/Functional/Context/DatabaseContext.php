<?php

declare(strict_types=1);

namespace App\Tests\Functional\Context;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use App\Domain\Entity\User;
use App\Domain\Entity\Pokemon;
use App\Domain\Entity\Type;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DatabaseContext implements Context
{
    static private EntityManagerInterface $em;
    static private UserPasswordHasherInterface $passwordHasher;

    public function __construct(KernelInterface $kernel, UserPasswordHasherInterface $passwordHasher)
    {
        self::$em = $kernel->getContainer()->get('doctrine')->getManager();
        self::$passwordHasher = $passwordHasher;
    }

    /**
     * @BeforeFeature
     */
    public static function resetData(): void
    {
        self::clearData();
        self::loadData();
    }

    private static function clearData(): void
    {
        $metadata = self::$em->getMetadataFactory()->getAllMetadata();
        if (!empty($metadata)) {
            $tool = new SchemaTool(self::$em);
            $tool->dropSchema($metadata);
            $tool->createSchema($metadata);
        }
    }

    private static function loadData(): void
    {
        $user = new User();
        $user->setId();
        $user->setUsername('user1@example.com');
        $user->setPassword(
            self::$passwordHasher->hashPassword($user, '1234567890')
        );
        self::$em->persist($user);

        $typeElectric = new Type('Electric');
        $typeIce = new Type('Ice');
        self::$em->persist($typeElectric);
        self::$em->persist($typeIce);

        $pokemon = new Pokemon(1, 'Pikachu', $typeElectric, $typeIce, 1, 1, 1, 1, 1, 1, 1, 1, false);
        self::$em->persist($pokemon);

        self::$em->flush();
    }
}
