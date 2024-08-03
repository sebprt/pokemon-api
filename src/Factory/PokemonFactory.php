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
            'id' => self::faker()->randomNumber(),
            'cry' => self::faker()->text(255),
            'image' => self::faker()->text(255),
            'name' => self::faker()->text(255),
        ];
    }
}
