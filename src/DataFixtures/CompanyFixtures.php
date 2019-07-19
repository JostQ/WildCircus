<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Media;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $company = new Company();
        $faker = Factory::create();

        $company->setName('Wild Circus');
        $company->setSlogan('Cot Cot Cot fait la Poule !');
        $company->setDescription($faker->text());
        $company->setHistory($faker->text());

        $logo = new Media();
        $logo->setCompany($company);
        $logo->setImgUrl('logo_200x200.png');

        $type = $manager->getRepository(Type::class)->findOneBy(['name' => 'logoCompany']);
        $logo->setType($type);

        $manager->persist($company);
        $manager->persist($logo);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TypeFixtures::class];
    }
}
