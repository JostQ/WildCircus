<?php

namespace App\DataFixtures;

use App\Entity\Company;
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

        $manager->persist($company);

        $manager->flush();
    }
}
