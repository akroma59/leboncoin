<?php

namespace App\DataFixtures;

use App\Entity\Addresses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AddressesFixtures extends Fixture
{
    public const ADDRESSE_REFERENCE = 'addresse';

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 10; $i++) { 
            $addresse = new Addresses();
            $addresse->setAddress("blabla$i");
            $addresse->setPostalcode(59000);
            $addresse->setCity("ville$i");
            $addresse->setRegion("region$i");
            $addresse->setCountry("France");
            $manager->persist($addresse);
            $this->setReference(self::ADDRESSE_REFERENCE.$i, $addresse);
        }
        
        $manager->flush();
    }
}
