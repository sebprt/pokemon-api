<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\PokemonFactory;
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

    public function testGetPokemons(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/pokemons',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetPokemon(): void
    {
        $factory = PokemonFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/pokemons/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetNonExistentPokemon(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/pokemons/7ce84785-3ed8-4269-a568-ff5e79edaa70',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreatePokemon(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/pokemons',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'name' => 'Charizard',
                    'image' => 'https://example.com/images/charizard.png',
                    'cry' => 'https://example.com/sounds/charizard-cry.mp3',
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testCreatePokemonWithInvalidData(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/pokemons',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // Missing 'name' field, and invalid 'image' URL
                    'image' => 'not-a-valid-url',
                    'cry' => 'https://example.com/sounds/charizard-cry.mp3',
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testUpdatePokemon(): void
    {
        $factory = PokemonFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/pokemons/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => 'Pikachu',
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testUpdatePokemonWithInvalidData(): void
    {
        $factory = PokemonFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/pokemons/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => '', // Invalid empty name
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testDeletePokemon(): void
    {
        $factory = PokemonFactory::random();

        $client = static::createClient();
        $client->request(
            'DELETE',
            '/pokemons/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteNonExistentPokemon(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/pokemons/7ce84785-3ed8-4269-a568-ff5e79edaa70',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }
}
