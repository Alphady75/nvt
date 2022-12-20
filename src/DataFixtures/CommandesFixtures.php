<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Services\QrcodeService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
class CommandesFixtures extends Fixture implements DependentFixtureInterface
{
    private $qrcodeService;

    public function __construct(QrcodeService $qrcodeService)
    {
        $this->qrcodeService = $qrcodeService;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbcommandes = 1; $nbcommandes <= 2000; $nbcommandes++){

            $user = $this->getReference('user_'. $faker->numberBetween(1, 5));
            $client = $this->getReference('client_'. $faker->numberBetween(1, 100));
            $conducteur = $this->getReference('conducteur_'. $faker->numberBetween(1, 20));
            $vehicule = $this->getReference('vehicule_'. $faker->numberBetween(1, 5));
            $itineraire = $this->getReference('itineraire_'. $faker->numberBetween(1, 200));

            $qrvalues = $nbcommandes;

            $qrcode = $this->qrcodeService->qrcode($qrvalues);

            $commande = new Commande();

            $commande->setItineraire($itineraire);
            $commande->setQrcode($qrcode);
            $commande->setObservation($faker->realText(100));
            $commande->setTarif($faker->numberBetween(50, 900));
            $commande->setUser($user);
            $commande->setClient($client);
            $commande->setConducteur($conducteur);
            $commande->setVehicule($vehicule);
            $commande->setDateReception(new \DateTime());
            $commande->setDateLivraison(new \DateTime());
            $manager->persist($commande);

            // Enregistre l'utilisateur dans une référence
            $this->addReference('commande_'. $nbcommandes, $commande);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            ItinerairesFixtures::class,
            ConducteursFixtures::class,
            ClientsFixtures::class,
            VehiculesFixtures::class,
        ];
    }
}