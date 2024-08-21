<?php

namespace App\Factory;

use App\Entity\GameSession;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

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
            'endedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'user' => UserFactory::random(),
            'answers' => [
                ...MultipleChoiceAnswerFactory::createRange(1, 20),
                ...TextInputAnswerFactory::createRange(1, 20),
            ]
        ];
    }
}
