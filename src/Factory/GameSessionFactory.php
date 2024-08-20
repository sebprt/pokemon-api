<?php

namespace App\Factory;

use App\Entity\GameSession;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<GameSession>
 */
final class GameSessionFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return GameSession::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'game' => GameFactory::random(),
            'isCompleted' => self::faker()->boolean(),
            'score' => self::faker()->randomNumber(),
            'startedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'user' => UserFactory::random(),
            'questions' => [
                ...MultipleChoiceQuestionFactory::createRange(1, 30),
                ...TextInputQuestionFactory::createRange(1, 30),
            ],
        ];
    }
}
