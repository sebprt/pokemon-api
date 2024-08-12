<?php

namespace App\Factory;

use App\Entity\Pokemon;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class PokemonFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Pokemon::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'cry' => self::faker()->url(),
            'image' => self::faker()->imageUrl(),
            'name' => self::faker()->word(),
        ];
    }
}
