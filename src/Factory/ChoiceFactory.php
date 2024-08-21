<?php

namespace App\Factory;

use App\Entity\Choice;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class ChoiceFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Choice::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'isCorrect' => self::faker()->boolean(),
            'label' => self::faker()->text(255),
        ];
    }
}
