<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    const TYPES = [
        "logoCompany",
        'historyCompany',
        'descriptionCompany',
        'cardEvent',
        'landingEvent',
        'descriptionEvent'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $type) {
            $newType = new Type();
            $newType->setName($type);
            $manager->persist($newType);
        }
        $manager->flush();
    }
}
