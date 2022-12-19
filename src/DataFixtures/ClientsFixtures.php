<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ClientsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbclients = 1; $nbclients <= 100; $nbclients++){

            $ville = $this->getReference('ville_'. $faker->numberBetween(1, 6));

            $client = new Client();           
            $client->setNom($faker->firstName());
            $client->setPrenom($faker->lastName());
            $client->setComptClientCompte($faker->numberBetween(10000000000, 90000000000));
            $client->setCivilite('Mme');
            $client->setAdresse($faker->streetAddress());
            $client->setTelephone($faker->phoneNumber());
            $client->setEmail($faker->email());
            $client->setVille($ville);
            $manager->persist($client);

            // Enregistre l'utilisateur dans une référence
            $this->addReference('client_'. $nbclients, $client);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VillesFixtures::class,
        ];
    }
}