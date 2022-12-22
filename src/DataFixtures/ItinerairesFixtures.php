<?php

namespace App\DataFixtures;

use App\Entity\Itineraire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ItinerairesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbitineraires = 1; $nbitineraires <= 200; $nbitineraires++){

            $client = $this->getReference('client_' . $faker->numberBetween(1, 100));

            $itineraire = new Itineraire();
            
            $itineraire->setDesignation($faker->country);
            $itineraire->setAdresse($faker->streetAddress);
            $itineraire->setTarif($faker->numberBetween(20, 200));
            $itineraire->setClient($client);
            $itineraire->setDescription($faker->time . ' ' . $faker->city . '<br>' .$faker->time . ' ' . $faker->city);
            $manager->persist($itineraire);
            
            // Enregistre dans une référence
            $this->addReference('itineraire_' . $nbitineraires, $itineraire);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientsFixtures::class,
        ];
    }
}