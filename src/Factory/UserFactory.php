<?php

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class UserFactory extends PersistentProxyObjectFactory
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public static function class(): string
    {
        return User::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->email(),
            'password' => self::faker()->password(),
            'roles' => [],
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'userRewards' => UserRewardFactory::createRange(1, 100),
            'userAvatars' => UserAvatarFactory::createRange(1, 50),
            'profile' => UserProfileFactory::createOne(),
        ];
    }

    protected function initialize(): static
    {
        return $this->afterInstantiate(fn (User $user) => $user->setPassword($this->hasher->hashPassword($user, $user->getPassword())));
    }
}
