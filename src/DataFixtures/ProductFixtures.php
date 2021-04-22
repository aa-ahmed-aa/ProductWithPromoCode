<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ProductFixtures extends Fixture
{
    /** @var Factory */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * 4 types of products
     *      - normal product without any promo_code
     *      - product discounted using promo_code 15 %
     *      - product discounted using promo_code 30 %
     *      - product discounted using both 15 % and 30 %
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product30And15 = $this->createProduct(
            $this->faker->name,
            $this->faker->numberBetween(1, 1000),
            'boots',
            '000003'
        );
        $manager->persist($product30And15);

        foreach (range(1, 20000) as $i) {
            $product = $this->createProduct(
                $this->faker->name,
                $this->faker->numberBetween(1, 1000),
                $this->faker->randomElement(['boots', 'shoes', 't-shirts', 'skirts']),
                $this->faker->uuid
            );

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function createProduct($name, $price, $category, $sku)
    {
        $product = new Product();
        $product->setName($name ?? $this->faker->name);
        $product->setPrice($price ?? $this->faker->numberBetween(1, 1000));
        $product->setCategory($category ?? $this->faker->randomElement(['boots', 'shoes', 't-shirts', 'skirts']));
        $product->setSku($sku ?? $this->faker->uuid);

        return $product;
    }
}
