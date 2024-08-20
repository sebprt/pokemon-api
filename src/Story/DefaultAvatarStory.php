<?php

namespace App\Story;

use App\Factory\AvatarFactory;
use Zenstruck\Foundry\Story;

final class DefaultAvatarStory extends Story
{
    public function build(): void
    {
        AvatarFactory::createMany(25);
    }
}
