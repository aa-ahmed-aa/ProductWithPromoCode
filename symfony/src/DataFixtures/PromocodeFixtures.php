<?php

namespace App\DataFixtures;

use App\Entity\Promocode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PromocodeFixtures extends Fixture
{
    /** @var Factory */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $promocode30 = new Promocode();
        $promocode30->setPercentage(30);
        $promocode30->setField('category');
        $promocode30->setValue('boots');

        $promocode15 = new Promocode();
        $promocode15->setPercentage(15);
        $promocode15->setField('sku');
        $promocode15->setValue('000003');

        $manager->persist($promocode30);
        $manager->persist($promocode15);

        $manager->flush();
    }
}
