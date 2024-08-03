<?php

namespace App\Story;

use App\Factory\GameFactory;
use Zenstruck\Foundry\Story;

final class DefaultGameStory extends Story
{
    public function build(): void
    {
        GameFactory::createMany(4);
    }
}
