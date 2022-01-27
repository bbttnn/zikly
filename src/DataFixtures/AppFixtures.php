<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
Use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
       
        $faker = Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++){
            $post= new Post();
            $post->setTitle($faker->sentence($nbwords = 2, $variablesNbwords = true))
            ->setContent($faker->sentence($nbwords = 15, $variablesNbwords = true))
            ->setAuthor($faker->name ())
            ->setCreatedAt($faker->dateTimeBetween('-6 months'));

            $manager->persist($post);


        }


        $manager->flush();
    }
}
