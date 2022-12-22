<?php

namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class DestinationsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbdestinations = 1; $nbdestinations <= 200; $nbdestinations++){

            $itineraire = $this->getReference('itineraire_' . $faker->numberBetween(1, 200));

            $destination = new Destination();
            
            $destination->setAdresseChargement($faker->streetAddress);
            $destination->setDateChargement($faker->dateTime);
            $destination->setAdresseLivraison($itineraire);
            $destination->setDateLivraison($faker->dateTime);
            $manager->persist($destination);
            
            // Enregistre dans une référence
            $this->addReference('destination_' . $nbdestinations, $destination);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ItinerairesFixtures::class,
        ];
    }
}