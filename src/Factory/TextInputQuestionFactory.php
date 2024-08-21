<?php

namespace App\Factory;

use App\Entity\TextInputQuestion;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<TextInputQuestion>
 */
final class TextInputQuestionFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return TextInputQuestion::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'correctAnswer' => self::faker()->text(255),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'label' => self::faker()->text(255),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }
}
