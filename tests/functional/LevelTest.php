<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\LevelFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class LevelTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        LevelFactory::createMany(10);
    }

    public function testGetLevels(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/levels',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetLevel(): void
    {
        $factory = LevelFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/levels/'.$factory->_get('id')->toString(),
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetNonExistentLevel(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/levels/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreateLevel(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/levels',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'number' => 1,
                    'requiredPoints' => 50,
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testCreateLevelWithBadRequest(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/levels',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // 'number' field should be an integer
                    'number' => '1',
                    'requiredPoints' => 50,
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(400);
    }

    public function testUpdateLevel(): void
    {
        $factory = LevelFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/levels/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'requiredPoints' => 500,
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testUpdateLevelWithBadRequest(): void
    {
        $factory = LevelFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/levels/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    // 'requiredPoints' should be an integer
                    'requiredPoints' => '500',
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(400);
    }

    public function testDeleteLevel(): void
    {
        $factory = LevelFactory::random();

        $client = static::createClient();
        $client->request(
            'DELETE',
            '/levels/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteNonExistentLevel(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/levels/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }
}
