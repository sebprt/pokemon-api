<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\AvatarFactory;
use App\Factory\LevelFactory;
use App\Factory\RewardFactory;
use App\Factory\UserFactory;
use App\Story\DefaultUserstory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class UserTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        AvatarFactory::createMany(50);
        LevelFactory::createMany(5);
        RewardFactory::createMany(200);
        UserFactory::createMany(5);
    }

    public function testGetUsers(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/users',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetUser(): void
    {
        $factory = UserFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/users/'.$factory->_get('id')->toString(),
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetNonExistentUser(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/users/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreateUser(): void
    {
        $level = LevelFactory::random();

        $client = static::createClient();
        $client->request(
            'POST',
            '/users',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'email' => 'johndoe@example.com',
                    'roles' => [],
                    'password' => 'dEq62546fDrwWM',
                    'createdAt' => '2024-08-22',
                    'level' => '/levels/' . $level->getId()->toString(),
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testCreateUserWithInvalidData(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/users',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // Missing 'email' field
                    'roles' => [],
                    'password' => 'dEq62546fDrwWM',
                    'createdAt' => '2024-08-22',
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testUpdateUser(): void
    {
        $factory = UserFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/users/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'password' => 'vD9C4h5A63Jhrd',
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testUpdateUserWithBadRequest(): void
    {
        $factory = UserFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/users/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    // 'password' field should be a string
                    'password' => 123,
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(400);
    }

    public function testDeleteUser(): void
    {
        $factory = UserFactory::random();

        $client = static::createClient();
        $client->request(
            'DELETE',
            '/users/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteNonExistentUser(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/users/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }
}
