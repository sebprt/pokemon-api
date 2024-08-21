<?php

namespace App\Factory;

use App\Entity\Game;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class GameFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Game::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'description' => self::faker()->text(),
            'name' => self::faker()->word(),
            'questions' => [
                ...MultipleChoiceQuestionFactory::createRange(1, 10),
                ...TextInputQuestionFactory::createRange(1, 10),
            ],
        ];
    }
}
