<?php

namespace App\Factory;

use App\Entity\TextInputQuestion;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

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
            'label' => self::faker()->text(255),
        ];
    }
}
