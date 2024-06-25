<?php

declare(strict_types=1);

namespace App\Tests\Scheduler\Handler;

use App\Scheduler\Handler\UpdateDailyPokemonTableHandler;
use App\Scheduler\Message\UpdateDailyPokemonTable;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UpdateDailyPokemonTableTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();
    }

    /** Todo : improve this test */
    public function testUpdatePokemonHandler(): void
    {
        $container = self::getContainer();

        $handler = new UpdateDailyPokemonTableHandler(
            $container->get(HttpClientInterface::class),
            $container->get(LoggerInterface::class),
            $container->get(EntityManagerInterface::class),
        );

        $handler(new UpdateDailyPokemonTable());

        $this->assertStringContainsString('Mise à jour réussie.', '$output');
    }
}
