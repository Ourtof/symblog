<?php

namespace App\DataFixtures;

use Faker;
use DateTimeImmutable;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 31; $i++) { 
            $ingredient = new Ingredient;
            $ingredient
                ->setName($faker->word())
                ->setPrice($faker->randomFloat(2, 0, 20))
                ->setCreatedAt(new DateTimeImmutable("now"));
    
            // prendre variable ingredient et transformer les setter en requêtes SQL, les préparer
            $manager->persist($ingredient);
        }
        
        // prend les persists et les envoies dans la database
        $manager->flush();
    }
}
