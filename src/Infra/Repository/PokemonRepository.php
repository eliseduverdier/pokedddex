<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PokemonRepository extends ServiceEntityRepository
{
    const LIMIT = 60; // TODO in config

    public function __construct(protected ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    public function filterBy(
        array $searchParams = [],
        array $sortParams = [],
        int $page = 1
    ): array {
        $qb = $this->createQueryBuilder('p')->select('p');

        foreach ($searchParams as $field => $value) {
            switch ($field) {
                case 'type':
                    $qb
                        ->leftJoin('p.type1', 't1')
                        ->leftJoin('p.type2', 't2')
                        ->andWhere($qb->expr()->orX(
                            $qb->expr()->eq('t1.name', ':type'),
                            $qb->expr()->eq('t2.name', ':type'),
                        ))
                        ->setParameter('type', "$value");
                    break;
                case 'name':
                    $qb
                        ->andWhere('p.name LIKE :name')
                        ->setParameter('name', "%$value%");
                    break;
            }
        }

        foreach ($sortParams as $field => $value) {
            $qb->addOrderBy("p.$field", $value);
        }

        $offset = $page > 1 ? ($page - 1) * self::LIMIT : 0;
        $qb->setFirstResult($offset);
        $qb->setMaxResults(self::LIMIT);

        return $qb->getQuery()->getResult();
    }

    public function getPokemonNames(): array
    {
        $names = $this->createQueryBuilder('p')
            ->select('p.name')
            ->getQuery()
            ->getResult();

        return array_column($names, 'name');
    }

    public function getAttributesName(): array
    {
        return $this->getClassMetadata()->getColumnNames();
    }

    public function getNewNumber(): int
    {
        $maxNumber = $this->createQueryBuilder('p')
            ->select('max(p.number)')
            ->getQuery()
            ->getOneOrNullResult();

        return $maxNumber[1] + 1;
    }
}
