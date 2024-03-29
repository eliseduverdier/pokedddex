<?php

namespace App\Action\Command;

use App\Domain\Entity\Pokemon;
use App\Domain\Entity\Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadPokemonFixtures extends Command
{
    const CSV_PATH = __DIR__ . '/../../../resources/fixtures/pokemons.csv'; // TODO in config
    const CSV_SEPARATOR = ',';

    public function __construct(protected EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('pokedex:load:pokemons')
            ->setDescription('Load the fixtures from the CSV to the DB.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $rows = $this->parseCSV();
            $this->loadInDb($rows);

            $output->writeln(sprintf('Successfully loaded %d pokemons fixtures !', count($rows)));

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("Error: {$e->getMessage()}");

            return Command::FAILURE;
        }
    }

    protected function parseCSV(): array
    {
        $rows = [];
        if (($handle = fopen(self::CSV_PATH, 'r')) !== false) {
            $headers = fgetcsv($handle, 0, self::CSV_SEPARATOR);
            while (($data = fgetcsv($handle, 0, self::CSV_SEPARATOR)) !== false) {
                $rows[] = array_combine($headers, $data);
            }
            fclose($handle);
        }

        return $rows;
    }

    protected function loadInDB(array $rows): void
    {
        // 1. Load types
        $types = array_unique(array_column($rows, 'Type 1') + array_column($rows, 'Type 2'));
        $typeEntities = []; // Where we will store Type Objects for Pokemons later
        foreach ($types as $typeName) {
            $typeEntity = (new Type(
                $typeName
            ));
            $typeEntities[$typeName] = $typeEntity;

            $this->em->persist($typeEntity);
        }
        $this->em->flush();

        // 2. Load pokemons
        foreach ($rows as $line) {
            $pokemon = (new Pokemon(
                $line['#'],
                $line['Name'],
                $typeEntities[$line['Type 1']],
                $typeEntities[$line['Type 2']] ?? null,
                $line['Total'],
                $line['HP'],
                $line['Attack'],
                $line['Defense'],
                $line['Sp. Atk'],
                $line['Sp. Def'],
                $line['Speed'],
                $line['Generation'],
                $line['Legendary'] === 'True', // map to boolean
            ));
            $this->em->persist($pokemon);
        }
        $this->em->flush();
    }
}
