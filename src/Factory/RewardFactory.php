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
            'condition' => [],
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'game' => GameFactory::new(),
            'name' => self::faker()->text(255),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }
}
