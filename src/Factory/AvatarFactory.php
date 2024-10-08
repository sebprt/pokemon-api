<?php

namespace App\Factory;

use App\Entity\Avatar;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class AvatarFactory extends PersistentProxyObjectFactory
{

    public static function class(): string
    {
        return Avatar::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->word(),
            'unlockPoints' => self::faker()->randomNumber(),
            'url' => self::faker()->imageUrl(),
        ];
    }
}
