<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $roles[] = 'ROLE_ADMIN';

        $user->setRoles($roles)
             ->setEmail("user1@symfony.com")
             ->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         'the_new_password'
                     ));

        $manager->persist($user);

        $manager->flush();
    }
}
