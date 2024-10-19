<?php

namespace App\Factory;

use App\Entity\User;
use App\Entity\UserReward;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class UserRewardFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return UserReward::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'user' => UserFactory::random(),
            'reward' => RewardFactory::random(),
            'unlockedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }
}
