<?php

declare(strict_types=1);

namespace App\Scheduler\Handler;

use App\Entity\Pokemon;
use App\Scheduler\Message\UpdateDailyPokemonTable;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
readonly class UpdateDailyPokemonTableHandler
{
    public function __construct(
        private HttpClientInterface $client,
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(UpdateDailyPokemonTable $message): void
    {
        $response = $this->client->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=2000');

        if (200 !== $response->getStatusCode()) {
            $this->logger->error('Erreur lors de la récupération des données.');

            return;
        }

        $data = $response->toArray();

        foreach ($data['results'] as $pokemon) {
            $response = $this->client->request('GET', $pokemon['url']);

            $result = $response->toArray();

            $pokemon = $this->entityManager->getRepository(Pokemon::class)->find($result['id']);

            if (!$pokemon) {
                $pokemon = new Pokemon();
            }

            $pokemon->setPokedexId($result['id']);
            $pokemon->setName($result['name']);
            $pokemon->setImage($result['sprites']['other']['home']['front_default'] ?? "");
            $pokemon->setCry($result['cries']['legacy'] ?? '');

            $this->entityManager->persist($pokemon);
        }

        $this->entityManager->flush();
    }
}
