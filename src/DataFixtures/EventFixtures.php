<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Media;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for($i = 1; $i < 11; $i++) {
            $event = new Event();
            $event->setName($faker->sentence(3));
            $event->setDescription($faker->paragraph);
            $event->setPrice($faker->randomFloat(2, 5, 30));
            $event->setAddress($faker->streetAddress);
            $event->setCity($faker->city);
            $event->setPostal('3300' . $i);
            $event->setDate($faker->dateTime('2030-01-01'));

            $cardType = $manager->getRepository(Type::class)->findOneBy(['name' => 'cardEvent']);
            $landingType = $manager->getRepository(Type::class)->findOneBy(['name' => 'landingEvent']);
            $descType = $manager->getRepository(Type::class)->findOneBy(['name' => 'descriptionEvent']);

            $card = new Media();
            $card->setImgUrl($i . '.jpg');
            $card->setType($cardType);
            $card->setEvent($event);

            $landing = new Media();
            $landing->setImgUrl($i . '.jpg');
            $landing->setType($landingType);
            $landing->setEvent($event);

            $desc = new Media();
            $desc->setImgUrl($i . '.jpg');
            $desc->setType($descType);
            $desc->setEvent($event);

            $manager->persist($event);
            $manager->persist($card);
            $manager->persist($landing);
            $manager->persist($desc);
        }
        $manager->flush();
    }
}
