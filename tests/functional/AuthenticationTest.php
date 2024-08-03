<?php

namespace App\Tests\functional;

use App\Story\DefaultUserStory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class AuthenticationTest extends WebTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        DefaultUserStory::load();
    }

    public function testLogin()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/login',
            [
                'json' => [
                    'email' => 'test@test.com',
                    'password' => 'password',
                ],
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
