<?php

namespace App\DataFixtures;

use App\Entity\VinylMix;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $mix = new VinylMix();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDiscription('A pure mix of drummers turned singers!');
        $genres = ['pop', 'rock'];
        $mix->setGenre($genres[array_rand($genres)]);
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));
        
        $manager->persist($mix);
        $manager->flush();
    }
}
