<?php

namespace App\Story;

use App\Factory\PokemonFactory;
use Zenstruck\Foundry\Story;

final class DefaultPokemonStory extends Story
{
    public function build(): void
    {
        PokemonFactory::createMany(100);
    }
}
