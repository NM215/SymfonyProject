<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for( $i=0; $i<30; $i++){

            $post = new Post();
            $post->setTitle($faker->sentence($nbWords=2, $variableNbWords = true))
                ->setContent($faker->sentence($nbWords=150, $variableNbWords = true));

            $manager->persist($post);
        }

        $manager->flush();
    }
}
