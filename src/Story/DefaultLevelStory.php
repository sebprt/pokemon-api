<?php

namespace App\Story;

use App\Factory\LevelFactory;
use Zenstruck\Foundry\Story;

final class DefaultLevelStory extends Story
{
    public function build(): void
    {
        LevelFactory::createMany(100);
    }
}
