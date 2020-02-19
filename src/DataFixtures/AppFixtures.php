<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user1 = new User();
        $user1->setUsername("kbustamante");
        $user1->setEmail("kevin.bustamante@mail.novancia.fr");
        $user1->setRoles(["ROLE_ADMIN"]);
        $password = $this->encoder->encodePassword($user1, 'kevin');
        $user1->setPassword($password);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("kbustam");
        $user2->setEmail("kevin.bustamante1@orange.fr");
        $user2->setRoles(["ROLE_USER"]);
        $password = $this->encoder->encodePassword($user2, 'kevin');
        $user2->setPassword($password);
        $manager->persist($user2);
        
        $manager->flush();
    }
}
