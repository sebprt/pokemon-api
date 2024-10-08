<?php

namespace App\Factory;

use App\Entity\Reward;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class RewardFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Reward::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->word(),
            'url' => self::faker()->imageUrl(),
            'unlockPoints' => self::faker()->randomNumber(),
        ];
    }
}
