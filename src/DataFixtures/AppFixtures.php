<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i <10; $i++) { 
            
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setFirstname($faker->FirstName)
                ->setLastname($faker->LastName)
                ->setPassword(password_hash('user', PASSWORD_BCRYPT))
                ->setRoles(['ROLE_USER'])
                ->setImage($faker->imageUrl)
                ->setJob($faker->randomElement(['RH', 'Informatique', 'Comptabilité', 'Direction']))
                ->setContract($faker->randomElement(['CDI', 'CDD', 'Interim']))
                ->setReleaseDate($faker->dateTime);

            $manager->persist($user);
        }
        
        $admin = new User();
        $admin
            ->setEmail('rh@hb.com')
            ->setFirstname($faker->FirstName)
            ->setLastname($faker->LastName)
            ->setPassword(password_hash('azerty123', PASSWORD_BCRYPT))
            ->setRoles(['ROLE_ADMIN'])
            ->setImage($faker->imageUrl)
            ->setJob('RH')
            ->setContract('CDI')
            ->setReleaseDate($faker->dateTime);

            $manager->persist($admin);

        $manager->flush();
    }
}
