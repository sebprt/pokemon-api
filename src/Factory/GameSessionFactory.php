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
            'questionsAnswered' => self::faker()->randomNumber(),
            'correctAnswers' => self::faker()->randomNumber(),
            'accuracy' => self::faker()->randomFloat(),
            'currentStreak' => self::faker()->randomNumber(),
            'maxStreak' => self::faker()->randomNumber(),
            'earnedExperience' => self::faker()->randomNumber(),
        ];
    }
}
