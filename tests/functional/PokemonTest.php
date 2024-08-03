<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Story\DefaultPokemonStory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class PokemonTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        DefaultPokemonStory::load();
    }

    public function testGetGames(): void
    {
        $response = static::createClient()->request('GET', '/games', ['headers' => ['Accept' => 'application/json']]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertJsonContains(['code' => 401, 'message' => 'JWT Token not found']);
    }

    public function testGetGame(): void
    {
        $response = static::createClient()->request('GET', '/games', ['headers' => ['Accept' => 'application/json']]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertJsonContains(['code' => 401, 'message' => 'JWT Token not found']);
    }

    public function testCreateGame(): void
    {
        $response = static::createClient()->request('GET', '/games', ['headers' => ['Accept' => 'application/json']]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertJsonContains(['code' => 401, 'message' => 'JWT Token not found']);
    }

    public function testUpdateGame(): void
    {
        $response = static::createClient()->request('GET', '/games', ['headers' => ['Accept' => 'application/json']]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertJsonContains(['code' => 401, 'message' => 'JWT Token not found']);
    }

    public function testDeleteGame(): void
    {
        $response = static::createClient()->request('GET', '/games', ['headers' => ['Accept' => 'application/json']]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertJsonContains(['code' => 401, 'message' => 'JWT Token not found']);
    }
}
