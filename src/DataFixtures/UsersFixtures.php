<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UsersFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbUsers = 1; $nbUsers <= 5; $nbUsers++){
            $user = new User();
            if($nbUsers === 1){
                $user->setRoles(['ROLE_ADMIN']);
                $user->setEmail('admin@gmail.com');
            }else{
                $user->setRoles(['ROLE_MODERATEUR']);
                $user->setEmail($faker->email);
            }                
            $user->setNom($faker->firstName());
            $user->setGenre('Homme');
            $user->setPrenom($faker->lastName());
            $user->setApropos($faker->realText(900));
            //$user->setIsVerified($faker->numberBetween(0, 1));
            $user->setPassword($this->encoder->hashPassword($user, 'azerty'));
            $manager->persist($user);

            // Enregistre l'utilisateur dans une référence
            $this->addReference('user_'. $nbUsers, $user);
        }

        $manager->flush();
    }
}
