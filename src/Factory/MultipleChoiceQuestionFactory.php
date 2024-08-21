<?php

namespace App\Factory;

use App\Entity\MultipleChoiceQuestion;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class MultipleChoiceQuestionFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return MultipleChoiceQuestion::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'label' => self::faker()->text(255),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'choices' => ChoiceFactory::createRange(1, 5),
        ];
    }
}
