<?php

namespace App\DataFixtures;

use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class VehiculesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbvehicules = 1; $nbvehicules <= 5; $nbvehicules++){
            $vehicule = new Vehicule();              
            $vehicule->setName($faker->companySuffix());
            $vehicule->setDescription($faker->realText(200));
            $vehicule->setReference($faker->realText(60));
            $manager->persist($vehicule);

            // Enregistre dans une référence
            $this->addReference('vehicule_'. $nbvehicules, $vehicule);
        }

        $manager->flush();
    }
}