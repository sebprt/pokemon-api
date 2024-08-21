<?php

namespace App\Factory;

use App\Entity\MultipleChoiceAnswer;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class MultipleChoiceAnswerFactory extends PersistentProxyObjectFactory
{

    public static function class(): string
    {
        return MultipleChoiceAnswer::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'choice' => ChoiceFactory::new(),
            'date' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'isCorrect' => self::faker()->boolean(),
            'question' => MultipleChoiceQuestionFactory::random(),
            'user' => UserFactory::random(),
        ];
    }
}
