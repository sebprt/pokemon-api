<?php

namespace App\Factory;

use App\Entity\TextInputAnswer;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class TextInputAnswerFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return TextInputAnswer::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'content' => self::faker()->text(255),
            'date' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'isCorrect' => self::faker()->boolean(),
            'question' => MultipleChoiceQuestionFactory::random(),
            'user' => UserFactory::random(),
        ];
    }
}
