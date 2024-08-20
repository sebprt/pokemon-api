<?php

namespace App\Story;

use App\Factory\RewardFactory;
use Zenstruck\Foundry\Story;

final class DefaultRewardStory extends Story
{
    public function build(): void
    {
        RewardFactory::createMany(200);
    }
}
