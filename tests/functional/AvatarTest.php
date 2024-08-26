<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\AvatarFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class AvatarTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        AvatarFactory::createMany(50);
    }

    public function testGetAvatars(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/avatars',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetAvatar(): void
    {
        $factory = AvatarFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/avatars/'.$factory->_get('id'),
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetNonExistentAvatar(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/avatars/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreateAvatar(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/avatars',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'name' => 'Strategic Warfare',
                    'url' => 'https://example.com',
                    'unlockPoints' => 1000,
                    'isUnlock' => true,
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testCreateAvatarWithInvalidData(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/avatars',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // 'unlockPoints' should be positive
                    'name' => 'Strategic Warfare',
                    'url' => 'https://example.com',
                    'unlockPoints' => 0,
                    'isUnlock' => false,
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreateAvatarWithBadRequest(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/avatars',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // 'isUnlock' field is not a boolean
                    'name' => 'Strategic Warfare',
                    'url' => 'https://example.com',
                    'unlockPoints' => 0,
                    'isUnlock' => 1,
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(400);
    }

    public function testUpdateAvatar(): void
    {
        $factory = AvatarFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/avatars/'.$factory->_get('id'),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => 'Eco Tycoon',
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testUpdateAvatarWithInvalidData(): void
    {
        $factory = AvatarFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/avatars/'.$factory->_get('id'),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => '',
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testDeleteAvatar(): void
    {
        $factory = AvatarFactory::random();

        $client = static::createClient();
        $client->request(
            'DELETE',
            '/avatars/'.$factory->_get('id'),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteNonExistentAvatar(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/avatars/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }
}
