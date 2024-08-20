<?php

namespace App\DataFixtures;

use App\Story\DefaultAvatarStory;
use App\Story\DefaultGameStory;
use App\Story\DefaultLevelStory;
use App\Story\DefaultRewardStory;
use App\Story\DefaultUserStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultAvatarStory::load();
        DefaultGameStory::load();
        DefaultLevelStory::load();
        DefaultRewardStory::load();
//        DefaultUserStory::load();
    }
}
