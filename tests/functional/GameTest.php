<?php

namespace App\Tests\functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\GameFactory;
use App\Story\DefaultGameStory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class GameTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();

        DefaultGameStory::load();
    }

    public function testGetGames(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/games',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetGame(): void
    {
        $factory = GameFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/games/'.$factory->_get('id')->toString(),
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseIsSuccessful();
    }

    public function testGetNonExistentGame(): void
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/games/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            ['headers' => ['Content-Type' => 'application/json']]
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreateGame(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/games',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'name' => 'Strategic Warfare',
                    'description' => 'A complex real-time strategy game where players must manage resources, build armies, and conquer territories to achieve dominance.',
                    'questions' => [
                        [
                            'type' => 'multiple_choice',
                            'label' => 'Quel type de ressource est le plus important dans Strategic Warfare ?',
                            'media' => '/images/resources.jpg',
                            'choices' => [
                                'Or',
                                'Bois',
                                'Pierre',
                                'Nourriture'
                            ],
                        ],
                        [
                            'type' => 'text_input',
                            'label' => 'Quelle est la limite maximale d\'unités que vous pouvez contrôler simultanément ?',
                            'media' => '/images/army.jpg',
                            'answer' => '200',
                        ],
                        [
                            'type' => 'text_input',
                            'label' => 'Combien de types différents de terrains sont présents dans le jeu ?',
                            'media' => '/images/terrain.jpg',
                            'answer' => '6',
                        ],
                        [
                            'type' => 'text_input',
                            'label' => 'Quelle est la durée moyenne d\'une partie en mode conquête ?',
                            'media' => '',
                            'answer' => '45 minutes',
                        ],
                    ]
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testCreateGameWithInvalidData(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/games',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    // Missing 'description' field
                    'name' => 'Strategic Warfare',
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testUpdateGame(): void
    {
        $factory = GameFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/games/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => 'Eco Tycoon',
                ],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testUpdateGameWithInvalidData(): void
    {
        $factory = GameFactory::random();

        $client = static::createClient();
        $client->request(
            'PATCH',
            '/games/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/merge-patch+json'],
                'json' => [
                    'name' => '',
                ],
            ],
        );

        $this->assertResponseStatusCodeSame(422);
    }

    public function testDeleteGame(): void
    {
        $factory = GameFactory::random();

        $client = static::createClient();
        $client->request(
            'DELETE',
            '/games/'.$factory->_get('id')->toString(),
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteNonExistentGame(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/games/07d8a11b-308e-4543-8bf3-ae28bd8578fe',
            [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testGetGameQuestions(): void
    {
        $game = GameFactory::random();

        $client = static::createClient();
        $client->request(
            'GET',
            '/games/' . $game->_get('id')->toString() . '/questions',
        );

        $this->assertResponseIsSuccessful();
    }

    public function testAddGameQuestion(): void
    {
        $game = GameFactory::random();

        $client = static::createClient();
        $client->request(
            'POST',
            '/games/' . $game->_get('id')->toString() . '/questions',
            [
                'json' => [
                    'label' => 'Quel est le meilleur jeux Pokemon ?',
                    'media' => 'https://example/image.jpg',
                    'type' => 'multiple_choice',
                    'choices' => [
                        [
                            'label' => 'Or',
                            'isCorrect' => true,
                        ]
                    ]
                ]
            ]
        );

        $this->assertResponseIsSuccessful();
    }
}
