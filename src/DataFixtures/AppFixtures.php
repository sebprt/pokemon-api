<?php

namespace App\DataFixtures;

use App\Entity\Avatar;
use App\Factory\AvatarFactory;
use App\Factory\GameFactory;
use App\Factory\GameSessionFactory;
use App\Factory\LevelFactory;
use App\Factory\RewardFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AvatarFactory::createMany(50);
        LevelFactory::createMany(20);
        RewardFactory::createMany(200);
        GameFactory::createMany(4);
        UserFactory::createMany(5);
        GameSessionFactory::createMany(20);
    }
}
