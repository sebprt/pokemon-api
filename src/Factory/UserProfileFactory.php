<?php

namespace App\Factory;

use App\Entity\UserProfile;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<UserProfile>
 */
final class UserProfileFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return UserProfile::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'accuracyRate' => self::faker()->randomFloat(),
            'experiencePoints' => self::faker()->randomNumber(),
            'gamesPlayed' => self::faker()->randomNumber(),
            'level' => self::faker()->randomNumber(),
            'totalPoints' => self::faker()->randomNumber(),
        ];
    }
}
