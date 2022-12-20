<?php

namespace App\DataFixtures;

use App\Entity\Conducteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ConducteursFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbconducteurs = 1; $nbconducteurs <= 20; $nbconducteurs++){

            $conducteur = new Conducteur();           
            $conducteur->setNom($faker->firstName());
            $conducteur->setPrenom($faker->lastName());
            $conducteur->setPrenom2($faker->lastName());
            $conducteur->setCivilite('Mr');
            $conducteur->setCode($faker->postcode());
            $conducteur->setPoste($faker->companySuffix);
            $conducteur->setService($faker->companySuffix);
            $conducteur->setSociete($faker->company);
            $conducteur->setAppartenance($faker->title);
            $conducteur->setEntreprise($faker->company);
            $conducteur->setVillenaissance($faker->city);
            $conducteur->setVillePermis($faker->city);
            $conducteur->setNumPermis($faker->buildingNumber);
            $conducteur->setNumcartetachy($faker->buildingNumber);
            $conducteur->setNumCarteVital($faker->buildingNumber);
            $conducteur->setTypePermis('Type 1');
            $conducteur->setNationalite($faker->country);
            $conducteur->setAdresse($faker->streetAddress());
            $conducteur->setDomicile($faker->streetAddress());
            $conducteur->setTelephone($faker->phoneNumber());
            $conducteur->setContactsUrgence($faker->name . ' ' . $faker->name . ' (' . $faker->phoneNumber() . ' - ' . $faker->phoneNumber() . ')');
            $conducteur->setTelpersonnel($faker->phoneNumber());
            $conducteur->setEmail($faker->email());
            $conducteur->setEmailPerso($faker->email());
            $conducteur->setMemo($faker->realText(90));
            $conducteur->setTypeContrat('CDI');
            $conducteur->setDateEntre(new \DateTime());
            $conducteur->setDateDebutEnciennete(new \DateTime());
            $conducteur->setDatenaissance(new \DateTime());
            $conducteur->setDateFinContrat(new \DateTime());
            $conducteur->setChauffeur($faker->numberBetween(0, 1));
            $conducteur->setTaille($faker->numberBetween(1.0, 2.80));
            $conducteur->setPointure($faker->numberBetween(30, 50));
            $conducteur->setCadeauFinAnnee($faker->numberBetween(0, 1));
            $conducteur->setStatut(['Actif']);
            $conducteur->setEmeteurPasseport($faker->title);
            $manager->persist($conducteur);

            // Enregistre l'utilisateur dans une référence
            $this->addReference('conducteur_'. $nbconducteurs, $conducteur);
        }

        $manager->flush();
    }
}
