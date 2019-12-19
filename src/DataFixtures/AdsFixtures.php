<?php

namespace App\DataFixtures;

use App\Entity\Ads;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AdsFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 10 ; $i++) { 

            $ad = new Ads();
            $ad->setCreatedBy($this->getReference(UsersFixtures::USER_REFERENCE.$i));
            $ad->setTitle("blabla$i");
            $ad->setDescription("blabla$i");
            $ad->setPrice("20$i");
            $ad->setSlug("test$i");
            $ad->setLanguage('fr');
            $ad->setState("new");
            $ad->setDatePublish(new \DateTime('now'));
            $ad->setDateExpire(new \DateTime('now'));
            $ad->setCategory($this->getReference(CategoriesFixtures::CATEGORIES_REFERENCE.$i));
            $ad->setLocation($this->getReference(AddressesFixtures::ADDRESSE_REFERENCE.$i));         
            $manager->persist($ad);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UsersFixtures::class,
            CategoriesFixtures::class,
            AddressesFixtures::class,
        );
    }
   
}
