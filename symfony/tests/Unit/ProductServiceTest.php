<?php


namespace App\Tests\Unit;


use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductServiceTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /** @var ProductService */
    private $productService;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->productService = new ProductService(
            $kernel->getContainer(),
            $kernel->getContainer()->get('knp_paginator'),
            $kernel->getContainer()->get('doctrine.orm.entity_manager'),
            $this->entityManager->getRepository('App\Entity\Product'),
            $this->entityManager->getRepository('App\Entity\Promocode'),
        );
    }

    public function test_get_product_with_discount(): void
    {
        $paginator = $this->productService->getProductWithDiscount();

        //Default is 10 items per page
        $this->assertEquals(10, count($paginator->getItems()));
    }
}
