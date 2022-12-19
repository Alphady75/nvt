<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class VillesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $villes = [
            1 => [
                'name' => 'Paris',
                'longitude' => 2.3522219,
                'latitude' => 48.856614,
            ],
            2 => [
                'name' => 'Marseille',
                'longitude' => 5.36978,
                'latitude' => 43.296482,
            ],
            3 => [
                'name' => 'Lion',
                'longitude' => 4.835659,
                'latitude' => 45.764043,
            ],
            4 => [
                'name' => 'Toulouse',
                'longitude' => 1.444209,
                'latitude' => 43.604652,
            ],
            5 => [
                'name' => 'Nantes',
                'longitude' => -1.553621,
                'latitude' => 47.218371,
            ],
            6 => [
                'name' => 'Lille',
                'longitude' => 3.057256,
                'latitude' => 50.62925,
            ],

        ];

        foreach($villes as $key => $value){

            //$user = $this->getReference('user_'. $faker->numberBetween(1, 100));

            $ville = new Ville();
            
            $ville->setName($value['name']);
            $ville->setLongitude($value['longitude']);
            $ville->setLatitude($value['latitude']);
            $ville->setSlug(strtolower($value['name']));
            $ville->setHexColor($faker->hexColor());
            $manager->persist($ville);

            // Enregistre la catégorie dans une référence
            $this->addReference('ville_' . $key, $ville);
        }

        $manager->flush();
    }
}