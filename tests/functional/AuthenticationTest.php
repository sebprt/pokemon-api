<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\AvatarFactory;
use App\Factory\LevelFactory;
use App\Factory\RewardFactory;
use App\Factory\UserAvatarFactory;
use App\Factory\UserFactory;
use App\Factory\UserRewardFactory;
use Faker\Factory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class AuthenticationTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        AvatarFactory::createMany(50);
        LevelFactory::createMany(5);
        RewardFactory::createMany(200);
        UserFactory::createOne([
            'email' => 'admin@example.com',
            'password' => 'admin',
        ]);
    }

    public function testLogin()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/login',
            [
                'json' => [
                    'email' => 'admin@example.com',
                    'password' => 'admin',
                ],
            ]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testLoginWithInvalidCredentials()
    {
        $faker = Factory::create();
        $client = static::createClient();

        $client->request(
            'POST',
            '/login',
            [
                'json' => [
                    'email' => $faker->email(),
                    'password' => $faker->password(),
                ],
            ]
        );

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function testLoginWithMissingField()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/login',
            [
                'json' => [
                    // Missing 'password' field
                    'email' => 'admin@example.com',
                ],
            ]
        );

        $this->assertResponseStatusCodeSame(400);
    }
}
