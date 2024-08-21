<?php

namespace App\Factory;

use App\Entity\UserReward;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<UserReward>
 */
final class UserRewardFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return UserReward::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'reward' => RewardFactory::new(),
            'unlockedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'user' => UserFactory::new(),
        ];
    }
}
