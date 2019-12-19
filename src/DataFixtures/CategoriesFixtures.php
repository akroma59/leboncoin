<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public const CATEGORIES_REFERENCE = 'category';

    const CATEGORIES = [
        ["Immobilier", "#00FF00"],
        ["Auto / Moto", "#F6B26B"],
        ["High-Tech", "#CC0000"],
        ["Spiritueux", "#660000"],
    ];

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 10 ; $i++) { 
            $category = new Categories();
            $category->setName("azerty$i");
            $category->setSlug("slug$i");
            $category->setColor("#00FF00");
            $manager->persist($category);
            $this->setReference(self::CATEGORIES_REFERENCE.$i, $category);
        }

        $manager->flush();

    }

}
