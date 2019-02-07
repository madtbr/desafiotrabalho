<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$user = new User();
       /*$user->setEmail("madtbr@gmail.com");
       $user->setRoles("ROLE_ADMIN");
       $encoder = $this->get('security.password_encoder');
       $pass = $encoder->encodePassword($user, "garnize");
       $user->setPassword($pass);
       $em->persist($user);*/
       $manager->flush();
    }
}
