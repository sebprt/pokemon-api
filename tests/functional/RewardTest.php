<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\RewardFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class RewardTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        RewardFactory::createMany(200);
    }

    public function testGetRewards(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/rewards',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetReward(): void
    {
        $factory = RewardFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/rewards/'.$factory->_get('id')->toString(),
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetNonExistentReward(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/rewards/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreateReward(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/rewards',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'name' => 'Strategic Warfare',
                    'unlockPoints' => 50,
                    'url' => 'https://example.com'
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testCreateRewardWithInvalidData(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/rewards',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // Missing 'name' field
                    'condition' => [
                        'Obtain 1000 points.'
                    ],
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testUpdateReward(): void
    {
        $factory = RewardFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/rewards/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => 'Uno',
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteReward(): void
    {
        $factory = RewardFactory::random();

        $client = static::createClient();
        $client->request(
            'DELETE',
            '/rewards/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteNonExistentReward(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/rewards/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }
}
