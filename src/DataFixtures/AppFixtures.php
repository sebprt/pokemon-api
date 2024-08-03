<?php

namespace App\DataFixtures;

use App\Story\DefaultGameStory;
use App\Story\DefaultPokemonStory;
use App\Story\DefaultUserStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultGameStory::load();
        DefaultPokemonStory::load();
        DefaultUserStory::load();
    }
}
