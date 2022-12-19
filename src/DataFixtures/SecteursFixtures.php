<?php

namespace App\DataFixtures;

use App\Entity\Secteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SecteursFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbsecteurs = 1; $nbsecteurs <= 50; $nbsecteurs++){

            $ville = $this->getReference('ville_'. $faker->numberBetween(1, 6));

            $secteur = new Secteur();           
            $secteur->setName($faker->domainWord());
            $secteur->setDescription($faker->realText(900));
            $secteur->setHexColor($faker->hexColor());
            $secteur->setVille($ville);
            $manager->persist($secteur);

            // Enregistre l'utilisateur dans une référence
            $this->addReference('secteur_'. $nbsecteurs, $secteur);
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
