<?php

namespace App\Factory;

use App\Entity\UserAvatar;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class UserAvatarFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return UserAvatar::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'avatar' => AvatarFactory::random(),
            'isCurrent' => self::faker()->boolean(),
            'unlockedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }
}
