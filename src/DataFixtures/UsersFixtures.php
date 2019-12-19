<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    public const USER_REFERENCE = 'user';

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 10 ; $i++) { 
            $user = new Users();
            $password = $this->encoder->encodePassword($user, "azerty$i");
            $user->setEmail("test@test$i.fr");
            $user->setPassword($password);
            $user->setFirstname("azer$i");
            $user->setLastname("ty$i");
            $user->setBirthday(new \DateTime('now'));
            $user->setLanguage('fr');
            $manager->persist($user);
            $user = $this->setReference(self::USER_REFERENCE.$i, $user);

        }
        $manager->flush();

    }
}
