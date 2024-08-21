<?php

namespace App\Factory;

use App\Entity\Level;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class LevelFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Level::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'number' => self::faker()->randomNumber(),
            'requiredPoints' => self::faker()->randomNumber(),
        ];
    }
}
