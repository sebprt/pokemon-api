<?php

declare(strict_types=1);

namespace App\Command;

use App\Scheduler\Handler\UpdateDailyPokemonTableHandler;
use App\Scheduler\Message\UpdateDailyPokemonTable;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:import-pokemon')]
class ImportPokemonCommand extends Command
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly LoggerInterface $logger,
        private readonly EntityManagerInterface $entityManager,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $handler = new UpdateDailyPokemonTableHandler($this->client, $this->logger, $this->entityManager);

        $handler(new UpdateDailyPokemonTable());

        return Command::SUCCESS;
    }
}
